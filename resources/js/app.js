import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const appDataEl = document.getElementById('appData');

if (appDataEl) {
    const parsedProduk = JSON.parse(appDataEl.dataset.produk);
    const dataBarang = Array.isArray(parsedProduk) ? parsedProduk : (parsedProduk.data ?? []);
    const urlBeli = appDataEl.dataset.urlBeli;
        const loginUrl = appDataEl.dataset.loginUrl;
        const isAuth = appDataEl.dataset.isAuth === '1';

    const esc = (str) => String(str ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');

    const formatRp = (angka) => {
        const n = Number(angka);
        return Number.isNaN(n) ? '0' : n.toLocaleString('id-ID');
    };

    const buatKartu = (item) => {
        const href = isAuth ? `${urlBeli}/${esc(item.id)}` : loginUrl;

        return `
        <div class="group bg-white rounded-4xl p-6 border border-gray-50 shadow-sm hover:shadow-xl hover:border-[#66c0f4]/20 transition-all duration-300 flex flex-col justify-between">
            <div class="text-center mb-6">
                <div class="bg-gray-50 w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Steam_icon_logo.svg/960px-Steam_icon_logo.svg.png"
                         class="w-10" alt="Steam">
                </div>
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">
                    ${esc(item.kategori)}
                </p>
                <h4 class="text-xl font-black text-[#1b2838] tracking-tighter">
                    Rp${formatRp(item.harga)}
                </h4>
            </div>

            <div class="border-t border-gray-50 pt-4 flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-bold text-gray-400 uppercase">Saldo</p>
                    <p class="text-md font-black text-[#5c7e10]">${esc(item.nama_barang)}</p>
                </div>
                <a href="${href}"
                   class="bg-gray-100 group-hover:bg-[#1b2838] text-gray-400 group-hover:text-white p-3 rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>
        </div>
    `;
};

    const filterDanUrutkan = (items, keyword, hargaRange, sort) => {
        const kataKunci = keyword.toLowerCase();

        const filtered = items.filter((item) => {
            const harga = Number(item.harga);
            const cocokKeyword = kataKunci === ''
                || String(item.nama_barang ?? '').toLowerCase().includes(kataKunci)
                || String(item.kategori ?? '').toLowerCase().includes(kataKunci)
                || String(item.harga ?? '').includes(kataKunci);

            let cocokHarga = true;
            if (hargaRange === 'Dibawah Rp50.000') cocokHarga = harga < 50000;
            else if (hargaRange === 'Rp50.000 - Rp200.000') cocokHarga = harga >= 50000 && harga <= 200000;
            else if (hargaRange === 'Diatas Rp200.000') cocokHarga = harga > 200000;

            return cocokKeyword && cocokHarga;
        });

        return filtered.sort((a, b) => (
            sort === 'termurah'
                ? Number(a.harga) - Number(b.harga)
                : Number(b.harga) - Number(a.harga)
        ));
    };

    const tampilkanProduk = (items) => {
        if (productCount) {
            productCount.textContent = String(items.length);
        }

        if (!productContainer) return;

        if (items.length === 0) {
            productContainer.innerHTML = `
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 italic">Produk tidak ditemukan.</p>
                </div>
            `;
            return;
        }

        productContainer.innerHTML = items.map(buatKartu).join('');
    };

    const ambilDataDariServer = async (keyword) => {
        if (!csrfToken) {
            throw new Error('CSRF token tidak ditemukan');
        }

        const response = await fetch('/katalog/search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ keyword })
        });

        if (!response.ok) throw new Error('Gagal narik data dari server');

        return response.json();
    };

    const render = async () => {
        const keyword = searchInput?.value.trim() ?? '';
        const hargaRange = document.querySelector('.filterHarga:checked')?.value ?? 'Semua Harga';
        const sort = sortOrder?.value ?? 'termurah';

        try {
            const produkDariServer = await ambilDataDariServer(keyword);
            tampilkanProduk(filterDanUrutkan(produkDariServer, keyword, hargaRange, sort));
        } catch (error) {
            console.error('AJAX Error bro:', error);
            tampilkanProduk(filterDanUrutkan(dataBarang, keyword, hargaRange, sort));
        }
    };

    searchInput?.addEventListener('input', render);
    filterStok?.addEventListener('change', render);
    sortOrder?.addEventListener('change', render);
    document.querySelectorAll('.filterHarga').forEach((radio) => {
        radio.addEventListener('change', render);
    });

    document.querySelector('.reset-filter')?.addEventListener('click', () => {
        if (searchInput) searchInput.value = '';
        if (filterStok) filterStok.checked = true;
        if (sortOrder) sortOrder.value = 'termurah';

        const filterHarga = document.querySelectorAll('.filterHarga');
        if (filterHarga.length > 0) {
            filterHarga[0].checked = true;
        }

        render();
    });

    render();
}

document.addEventListener('DOMContentLoaded', () => {
    const historySearchInput = document.getElementById('historySearchInput');
    const historySearchForm = document.getElementById('historySearchForm');
    const historyTable = document.querySelector('table');
    const historyColumnCount = historyTable?.querySelectorAll('thead th').length || 6;

    const applyHistoryFilter = () => {
        if (!historySearchInput) return;
        const keyword = historySearchInput.value.trim().toLowerCase();
        const historyBody = document.querySelector('tbody');
        if (!historyBody) return;

        historyBody.querySelectorAll('tr.history-no-match').forEach((row) => row.remove());

        const orderRows = historyBody.querySelectorAll('tr.history-order-row');
        let visibleIndex = 0;

        orderRows.forEach((row) => {
            const rowText = row.textContent.toLowerCase();
            const match = keyword === '' || rowText.includes(keyword);
            row.style.display = match ? '' : 'none';

            if (match) {
                visibleIndex += 1;
                const indexCell = row.querySelector('td:first-child');
                if (indexCell) indexCell.textContent = String(visibleIndex);
            }
        });

        if (visibleIndex === 0) {
            const noMatchRow = document.createElement('tr');
            noMatchRow.className = 'history-no-match';
            noMatchRow.innerHTML = `<td colspan="${historyColumnCount}" class="p-8 text-center text-gray-500">Tidak ada riwayat yang cocok.</td>`;
            historyBody.appendChild(noMatchRow);
        }
    };

    if (historySearchInput) {
        historySearchInput.addEventListener('input', applyHistoryFilter);
    }

    if (historySearchForm) {
        historySearchForm.addEventListener('submit', (event) => {
            event.preventDefault();
            applyHistoryFilter();
        });
    }
});

window.setCookie = function(name, value, days = 30) {
    let expires = "";
    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/; SameSite=Lax";
}

window.getCookie = function(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(';');
    for(let i=0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

window.deleteCookie = function(name) {
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function applyTheme(theme) {
    const shouldUseDark = theme === 'dark'
        || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);

    document.documentElement.classList.toggle('dark', shouldUseDark);
}

function applyFontSize(fontSize) {
    document.documentElement.setAttribute('data-font-size', fontSize || 'normal');
}

document.addEventListener('DOMContentLoaded', () => {
    const btnToggle = document.getElementById('dark-mode-toggle');
    const btnToggleMobile = document.getElementById('dark-mode-toggle-mobile');

    const toggleDarkMode = () => {
        const isDark = document.documentElement.classList.toggle('dark');
        const newTheme = isDark ? 'dark' : 'light';
        setCookie('theme', newTheme, 30);
        localStorage.setItem('theme', newTheme);
    };

    if (btnToggle) {
        btnToggle.addEventListener('click', toggleDarkMode);
    }

    if (btnToggleMobile) {
        btnToggleMobile.addEventListener('click', toggleDarkMode);
    }

    const prefForm = document.getElementById('preferences-form');
    if (prefForm) {
        prefForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const themeValue = document.querySelector('input[name="theme"]:checked')?.value;
            const fontSizeValue = document.getElementById('font_size')?.value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            try {
                const response = await fetch('/pengaturan/simpan', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ theme: themeValue, font_size: fontSizeValue })
                });

                if (!response.ok) throw new Error('Gagal menyimpan preferensi server');

                const result = await response.json();

                setCookie('theme', result.theme, 30);
                setCookie('font_size', result.font_size, 30);
                localStorage.setItem('theme', result.theme);
                localStorage.setItem('font_size', result.font_size);

                applyTheme(result.theme);
                applyFontSize(result.font_size);

                alert('Mantap! ' + result.message);
            } catch (error) {
                console.error('Error simpan preferensi:', error);
            }
        });
    }
});

window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
    if (getCookie('theme') === 'system') {
        applyTheme('system');
    }
});
