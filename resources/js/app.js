let dataBarang = JSON.parse(localStorage.getItem("barang")) || [];
let editIndex = -1;

const form = document.getElementById("formBarang");
const statistik = document.getElementById("statistik");

form.addEventListener("submit", (e) => {
    e.preventDefault();

    const kode = document.getElementById("kode").value.trim();
    const nama = document.getElementById("nama").value.trim();
    const kategori = document.getElementById("kategori").value;
    const stok = document.getElementById("stok").value;
    const harga = document.getElementById("harga").value;
    const tanggal = document.getElementById("tanggal").value;

    if (!kode || !nama || !kategori || !stok || !harga || !tanggal) {
        alert("Semua field wajib diisi!");
        return;
    }

    if (stok <= 0) {
        alert("Stok harus lebih dari 0");
        return;
    }

    if (harga <= 0) {
        alert("Harga harus lebih dari 0");
        return;
    }

    const barangBaru = {
        kode,
        nama,
        kategori,
        stok: Number(stok),
        harga: Number(harga),
        tanggal
    };

    if (editIndex === -1) {
        dataBarang.push(barangBaru);
    } else {
        dataBarang[editIndex] = barangBaru;
        editIndex = -1;
    }

    localStorage.setItem("barang", JSON.stringify(dataBarang));
    render();   

    console.log("DATA SEKARANG:", dataBarang);

    alert("Data berhasil ditambahkan!");

    form.reset();
});

const tableBody = document.getElementById("tableBody");

const render = () => {
    tableBody.innerHTML = "";

    const keyword = searchInput.value.toLowerCase();
    const kategori = filterKategori.value;

    const filtered = dataBarang.filter(item => {
        const cocokSearch =
            item.nama.toLowerCase().includes(keyword) ||
            item.kode.toLowerCase().includes(keyword);

        const cocokKategori =
            kategori === "" || item.kategori === kategori;

        return cocokSearch && cocokKategori;
    });

    filtered.forEach((item, index) => {
        tableBody.innerHTML += `
            <tr>
                <td>${item.kode}</td>
                <td>${item.nama}</td>
                <td>${item.kategori}</td>
                <td>${item.stok}</td>
                <td>${item.harga}</td>
                <td>${item.tanggal}</td>
                <td>
                    <button class="btn-edit" onclick="edit(${index})">Edit</button>
                    <button class="btn-delete" onclick="hapus(${index})">Hapus</button>
                </td>
            </tr>
        `;
    });

    // 🔥 STATISTIK (PINDAH KE SINI)
    const totalItem = dataBarang.length;

    const totalNilai = dataBarang.reduce((total, item) => {
        return total + (item.harga * item.stok);
    }, 0);

    const stokMenipis = dataBarang.filter(item => item.stok < 5).length;

    statistik.innerHTML = `
        <div style="text-align:center;">
            <img src="icon.png" width="200">
            <h3>Statistik</h3>
        </div>

        <p>📦 Total Item: ${totalItem}</p>
        <p>💰 Total Nilai: Rp${totalNilai}</p>
        <p>⚠️ Stok Menipis (<5): ${stokMenipis}</p>
    `;
};

const hapus = (index) => {
    const konfirmasi = confirm("Yakin mau hapus data ini?");
    
    if (konfirmasi) {
        dataBarang.splice(index, 1);

        localStorage.setItem("barang", JSON.stringify(dataBarang));

        render();
    }
};

const edit = (index) => {
    const item = dataBarang[index];

    document.getElementById("kode").value = item.kode;
    document.getElementById("nama").value = item.nama;
    document.getElementById("kategori").value = item.kategori;
    document.getElementById("stok").value = item.stok;
    document.getElementById("harga").value = item.harga;
    document.getElementById("tanggal").value = item.tanggal;

    editIndex = index;
};

const searchInput = document.getElementById("search");
searchInput.addEventListener("input", render);

const filterKategori = document.getElementById("filterKategori");
filterKategori.addEventListener("change", render);

render();
