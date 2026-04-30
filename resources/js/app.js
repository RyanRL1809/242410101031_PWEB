// ─────────────────────────────────────────
// Cek dulu apakah halaman ini punya #appData
// Biar nggak error di halaman lain
// ─────────────────────────────────────────
const appDataEl = document.getElementById("appData");
if (appDataEl) {

    // ─────────────────────────────────────
    // AMBIL DATA DARI BLADE
    // ─────────────────────────────────────
    const dataBarang = JSON.parse(appDataEl.dataset.produk);
    const urlBeli    = appDataEl.dataset.urlBeli;

    // ─────────────────────────────────────
    // TANGKAP ELEMEN
    // ─────────────────────────────────────
    const searchInput      = document.getElementById("searchInput");
    const filterStok       = document.getElementById("filterStok");
    const sortOrder        = document.getElementById("sortOrder");
    const productContainer = document.getElementById("productContainer");
    const productCount     = document.getElementById("productCount");

    // ─────────────────────────────────────
    // HELPER
    // ─────────────────────────────────────
    const esc = (str) => String(str ?? "")
        .replace(/&/g, "&amp;").replace(/</g, "&lt;")
        .replace(/>/g, "&gt;").replace(/"/g, "&quot;");

    const formatRp = (angka) => {
        const n = Number(angka);
        return isNaN(n) ? "0" : n.toLocaleString("id-ID");
    };

    // ─────────────────────────────────────
    // TEMPLATE KARTU
    // ─────────────────────────────────────
    const buatKartu = (item) => `
        <div class="group bg-white rounded-4xl p-6 border border-gray-50 shadow-sm
                    hover:shadow-xl hover:border-[#66c0f4]/20 transition-all duration-300
                    flex flex-col justify-between">

            <div class="text-center mb-6">
                <div class="bg-gray-50 w-16 h-16 rounded-2xl flex items-center justify-center
                            mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-transform">
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
                   class="bg-gray-100 group-hover:bg-[#1b2838] text-gray-400
                          group-hover:text-white p-3 rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>
        </div>
    `;

    // ─────────────────────────────────────
    // MAIN RENDER
    // ─────────────────────────────────────
    const render = () => {
        const keyword    = searchInput.value.toLowerCase().trim();
        const hargaRange = document.querySelector(".filterHarga:checked")?.value ?? "Semua Harga";
        const stokOnly   = filterStok.checked;
        const sort       = sortOrder.value;

        let filtered = dataBarang.filter(item => {
            const cocokSearch =
                item.nama_barang.toLowerCase().includes(keyword) ||
                item.kode_barang.toLowerCase().includes(keyword) ||
                String(item.harga).includes(keyword);

            let cocokHarga = true;
            const harga = Number(item.harga);
            if      (hargaRange === "Dibawah Rp50.000")      cocokHarga = harga < 50000;
            else if (hargaRange === "Rp50.000 - Rp200.000")  cocokHarga = harga >= 50000 && harga <= 200000;
            else if (hargaRange === "Diatas Rp200.000")       cocokHarga = harga > 200000;

            const cocokStok = stokOnly ? item.stok > 0 : true;

            return cocokSearch && cocokHarga && cocokStok;
        });

        filtered.sort((a, b) =>
            sort === "termurah"
                ? Number(a.harga) - Number(b.harga)
                : Number(b.harga) - Number(a.harga)
        );

        productCount.textContent = filtered.length;

        if (filtered.length === 0) {
            productContainer.innerHTML = `
                <div class="col-span-full py-20 text-center">
                    <p class="text-gray-400 italic">Produk tidak ditemukan 😅</p>
                </div>`;
            return;
        }

        productContainer.innerHTML = filtered.map(buatKartu).join("");
    };

    // ─────────────────────────────────────
    // EVENT LISTENERS
    // ─────────────────────────────────────
    searchInput.addEventListener("input", render);
    filterStok.addEventListener("change", render);
    sortOrder.addEventListener("change", render);
    document.querySelectorAll(".filterHarga").forEach(r =>
        r.addEventListener("change", render)
    );

    document.querySelector(".reset-filter")?.addEventListener("click", () => {
        searchInput.value = "";
        filterStok.checked = true;
        sortOrder.value = "termurah";
        document.querySelectorAll(".filterHarga")[0].checked = true;
        render();
    });

    // Render pertama kali
    render();
}