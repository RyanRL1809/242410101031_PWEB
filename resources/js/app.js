import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const appDataEl = document.getElementById('appData');

if (appDataEl) {
    const parsedProduk = JSON.parse(appDataEl.dataset.produk);
    const dataBarang = Array.isArray(parsedProduk) ? parsedProduk : (parsedProduk.data ?? []);
    const urlBeli = appDataEl.dataset.urlBeli;
    const searchInput = document.getElementById('searchInput');
    const filterStok = document.getElementById('filterStok');
    const sortOrder = document.getElementById('sortOrder');
    const productContainer = document.getElementById('productContainer');
    const productCount = document.getElementById('productCount');

    const esc = (str) => String(str ?? '')
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');

    const formatRp = (angka) => {
        const n = Number(angka);
        return Number.isNaN(n) ? '0' : n.toLocaleString('id-ID');
    };

    const buatKartu = (item) => `
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
                <a href="${urlBeli}/${esc(item.id)}"
                   class="bg-gray-100 group-hover:bg-[#1b2838] text-gray-400 group-hover:text-white p-3 rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>
        </div>
    `;

    const render = () => {
        const keyword = searchInput?.value.toLowerCase().trim() ?? '';
        const hargaRange = document.querySelector('.filterHarga:checked')?.value ?? 'Semua Harga';
        const stokOnly = filterStok?.checked ?? false;
        const sort = sortOrder?.value ?? 'termurah';

        let filtered = dataBarang.filter((item) => {
            const nama = String(item.nama_barang ?? '').toLowerCase();
            const kode = String(item.kode_barang ?? '').toLowerCase();
            const hargaText = String(item.harga ?? '');
            const cocokSearch = nama.includes(keyword) || kode.includes(keyword) || hargaText.includes(keyword);

            let cocokHarga = true;
            const harga = Number(item.harga);
            if (hargaRange === 'Dibawah Rp50.000') cocokHarga = harga < 50000;
            else if (hargaRange === 'Rp50.000 - Rp200.000') cocokHarga = harga >= 50000 && harga <= 200000;
            else if (hargaRange === 'Diatas Rp200.000') cocokHarga = harga > 200000;

            const cocokStok = stokOnly ? Number(item.stok) > 0 : true;

            return cocokSearch && cocokHarga && cocokStok;
        });

        filtered.sort((a, b) => (
            sort === 'termurah'
                ? Number(a.harga) - Number(b.harga)
                : Number(b.harga) - Number(a.harga)
        ));

        if (productCount) {
            productCount.textContent = String(filtered.length);
        }

        if (!productContainer) {
            return;
        }

        if (filtered.length === 0) {
            productContainer.innerHTML = `
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 italic">Produk tidak ditemukan.</p>
                </div>
            `;
            return;
        }

        productContainer.innerHTML = filtered.map(buatKartu).join('');
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
