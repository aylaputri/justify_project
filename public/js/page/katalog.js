    // NAVBAR
// Untuk burger menu
function toggleMenu() {
  const backdrop = document.getElementById("backdrop");
  const overlay = document.getElementById("overlay");
  const icon = document.getElementById("burger");

  backdrop.classList.toggle("active");
  overlay.classList.toggle("active");

  // Deteksi apakah kita di subfolder atau root
  const isSubfolder = window.location.pathname.includes("");
  const basePath = isSubfolder ? "../../../resources/views/page/home.blade.php" : "image/icon/";

  if (overlay.classList.contains("active")) {
    icon.src = basePath + "icon-close-putih.svg";
  }
  else {
    icon.src = basePath + "icon-burger.svg";
  }
}

// AUTO ACTIVE LINK NAVBAR
const link = document.querySelectorAll(".menu-desktop a, .menu-overlay a");
link.forEach(l => {
  if (l.href === window.location.href) {
    l.classList.add("active");
  }
});

// mixmatch
let pilihanatasan = "";
let pilihanbawahan = "";

function pilihItem(elemen, kategori) {
  const semuaPilihan = document.querySelectorAll("." + kategori);
  // Ketika user ganti pilihan stroke di baju sebelumnya hilang .
  // Hapus class 'active' dari semua gambar yang sebelumnya dikllik
  semuaPilihan.forEach((img) => {
    img.classList.remove("active");
  });
  // Tambahkan class 'active' pada satu gambar yang baru saja diklik
  elemen.classList.add("active");
  // Simpan alamat gambarnya untuk proses Mix nanti
  if (kategori === "atasan") {
    pilihanatasan = elemen.src;
  } else {
    pilihanbawahan = elemen.src;
  }
}

// Fungsi tombol mix
function gabungkanStyle() {
  if (pilihanatasan === "" || pilihanbawahan === "") {
    alert("Pilih dulu atasan dan bawahannya, Ya!");
    return;
  }

  const areaHasil = document.getElementById("result-display");
  const kotakGambar = document.getElementById("combined-preview");
  // Innsert gambar ke dalam kotak yang sudah di-setting vertikal di mixmatch.CSS
  kotakGambar.innerHTML = `
        <img src="${pilihanatasan}" alt="Atasan Terpilih">
        <img src="${pilihanbawahan}" alt="Bawahan Terpilih">
    `;
  areaHasil.style.display = "block";
  // Scroll otomatis ke hasil mixmatch
  areaHasil.scrollIntoView({ behavior: "smooth" });
}

//katalog
const cards = document.querySelectorAll(".products .card");
const details = document.getElementById("overlay-details");
const closeBtn = document.getElementById("closeBtn");

// buka modal
cards.forEach((card) => {
  card.addEventListener("click", () => {
    details.style.display = "flex";
  });
});

// tutup modal (klik X)
closeBtn.addEventListener("click", () => {
  details.style.display = "none";
});

// biar pas dipilih active
const sizes = document.querySelectorAll(".size-list span");

sizes.forEach((size) => {
  size.addEventListener("click", () => {
    sizes.forEach(s => s.classList.remove("active"));
    size.classList.add("active");
  });
});