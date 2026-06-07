// Filter & Search
const sortingSelect = document.getElementById("sorting");
const kategori = document.getElementById("kategori");
const size = document.getElementById("size");
const colors = document.getElementById("colors");

const searchInputs = document.querySelectorAll(".search-box input");

// Modal
const cards = document.querySelectorAll(".product-card");

const details = document.getElementById("overlay-details");
const closeBtn = document.getElementById("closeBtn");

const modalName = document.getElementById("modalName");
const modalPrice = document.getElementById("modalPrice");
const modalCategory = document.getElementById("modalCategory");
const modalDescription = document.getElementById("modalDescription");
const modalImage = document.getElementById("modalImage");

const modalSizes = document.getElementById("modalSizes");
const modalColors = document.getElementById("modalColors");

const checkoutBtn = document.getElementById("checkoutBtn");
const cartBtn = document.querySelector(".cart-btn");

// Smart sizing
const userHeight = document.getElementById("userHeight");
const userWeight = document.getElementById("userWeight");
const recommendedSize = document.getElementById("recommendedSize");

// Global variable
let selectedSize = null;
let selectedColor = null;
let currentSizeCharts = [];

// Update filter URL
function updateFilter() {

    const url = new URL(window.location.href);

    // Filter kategori
    if (kategori.value) {
        url.searchParams.set("kategori", kategori.value);
    } else {
        url.searchParams.delete("kategori");
    }

    // Filter size
    if (size.value) {
        url.searchParams.set("size", size.value);
    } else {
        url.searchParams.delete("size");
    }

    // Filter warna
    if (colors.value) {
        url.searchParams.set("colors", colors.value);
    } else {
        url.searchParams.delete("colors");
    }

    // Filter sorting
    if (sortingSelect.value) {
        url.searchParams.set("sorting", sortingSelect.value);
    } else {
        url.searchParams.delete("sorting");
    }

    // Redirect URL baru
    window.location.href = url;
}

// Event filter
sortingSelect.addEventListener("change", updateFilter);
kategori.addEventListener("change", updateFilter);
size.addEventListener("change", updateFilter);
colors.addEventListener("change", updateFilter);

// Search product realtime
searchInputs.forEach((input) => {

    input.addEventListener("input", () => {

        const keyword = input.value.toLowerCase().trim();

        // Sinkron semua input search
        searchInputs.forEach((otherInput) => {
            otherInput.value = input.value;
        });

        // Filter card product
        cards.forEach((card) => {

            const productName =
                (card.dataset.name || "").toLowerCase();

            const category =
                (card.dataset.category || "").toLowerCase();

            const description =
                (card.dataset.description || "").toLowerCase();

            const isMatch =
                productName.includes(keyword) ||
                category.includes(keyword) ||
                description.includes(keyword);

            card.style.display =
                isMatch ? "block" : "none";
        });
    });
});

// Open modal product
cards.forEach((card) => {

    card.addEventListener("click", () => {

        selectedSize = null;
        selectedColor = null;

        recommendedSize.innerText = "-";

        if (userHeight) userHeight.value = "";
        if (userWeight) userWeight.value = "";

        // Isi data modal
        modalName.innerText = card.dataset.name;
        modalPrice.innerText = "Rp " + card.dataset.price;
        modalCategory.innerText = card.dataset.category;
        modalDescription.innerText = card.dataset.description;
        modalImage.src = card.dataset.image;

        // Ambil size chart
        const sizeCharts =
            JSON.parse(card.dataset.sizecharts || "[]");

        currentSizeCharts = sizeCharts;

        const sizeChartBody =
            document.getElementById("sizeChartBody");

        sizeChartBody.innerHTML = "";

        // Render size chart
        sizeCharts.forEach((chart) => {

            sizeChartBody.innerHTML += `
                <tr>
                    <td>${chart.size}</td>
                    <td>${chart.length_cm}</td>
                    <td>${chart.width_cm}</td>
                </tr>
            `;
        });

        // Render size
        modalSizes.innerHTML = "";

        const sizes =
            card.dataset.sizes
            ? card.dataset.sizes.split(",")
            : [];

        sizes.forEach((sizeItem) => {

            const span = document.createElement("span");

            span.innerText = sizeItem;

            // Pilih size
            span.addEventListener("click", (e) => {

                e.stopPropagation();

                document
                    .querySelectorAll("#modalSizes span")
                    .forEach((s) => {
                        s.classList.remove("active");
                    });

                span.classList.add("active");

                selectedSize = sizeItem;
            });

            modalSizes.appendChild(span);
        });

        // Render warna
        modalColors.innerHTML = "";

        const colorList =
            card.dataset.colors
            ? card.dataset.colors.split(",")
            : [];

        colorList.forEach((colorItem) => {

            const span = document.createElement("span");

            span.innerText = colorItem;

            // Pilih warna
            span.addEventListener("click", (e) => {

                e.stopPropagation();

                document
                    .querySelectorAll("#modalColors span")
                    .forEach((c) => {
                        c.classList.remove("active");
                    });

                span.classList.add("active");

                selectedColor = colorItem;
            });

            modalColors.appendChild(span);
        });

        // Tampilkan modal
        details.classList.add("active");
    });
});

// Tutup modal dari tombol close
closeBtn.addEventListener("click", () => {
    details.classList.remove("active");
});

// Tutup modal jika klik backdrop
details.addEventListener("click", (e) => {

    if (e.target === details) {
        details.classList.remove("active");
    }
});

// Cegah modal tertutup saat isi modal diklik
const modalBox = document.querySelector(".modal");

if (modalBox) {

    modalBox.addEventListener("click", (e) => {
        e.stopPropagation();
    });
}

// Hitung smart sizing
function calculateSmartSize() {

    const height = parseInt(userHeight.value);
    const weight = parseInt(userWeight.value);

    // Jika input kosong
    if (!height || !weight) {

        recommendedSize.innerText = "-";

        return;
    }

    let recommended = null;

    // Logic size recommendation
    if (height <= 165 && weight <= 55) {

        recommended = "S";

    } else if (
        height <= 170 &&
        weight <= 65
    ) {

        recommended = "M";

    } else if (
        height <= 175 &&
        weight <= 75
    ) {

        recommended = "L";

    } else {

        recommended = "XL";
    }

    // Tampilkan hasil rekomendasi
    recommendedSize.innerText = recommended;

    // Auto select size
    document
        .querySelectorAll("#modalSizes span")
        .forEach((s) => {

            s.classList.remove("active");

            if (s.innerText === recommended) {

                s.classList.add("active");

                selectedSize = recommended;
            }
        });
}

// Jalankan smart sizing realtime
userHeight.addEventListener("input", calculateSmartSize);
userWeight.addEventListener("input", calculateSmartSize);

// Checkout product
checkoutBtn.addEventListener("click", (e) => {

    e.preventDefault();

    // Validasi size dan warna
    if (!selectedSize || !selectedColor) {

        alert("Pilih size dan warna terlebih dahulu!");

        return;
    }

    const product = {

        name: modalName.innerText,

        price: parseInt(
            modalPrice.innerText
                .replace("Rp", "")
                .replace(/\./g, "")
                .trim()
        ),

        image: modalImage.src,

        size: selectedSize,

        color: selectedColor,

        qty: 1,
    };

    // Simpan checkout
    localStorage.setItem(
        "checkout",
        JSON.stringify([product])
    );

    window.location.href = "/checkout";
});

// Tambah product ke cart
cartBtn.addEventListener("click", (e) => {

    e.preventDefault();

    // Validasi size dan warna
    if (!selectedSize || !selectedColor) {

        alert("Pilih size dan warna terlebih dahulu!");

        return;
    }

    const product = {

        name: modalName.innerText,

        price: parseInt(
            modalPrice.innerText
                .replace("Rp", "")
                .replace(/\./g, "")
                .trim()
        ),

        image: modalImage.src,

        size: selectedSize,

        color: selectedColor,

        qty: 1,
    };

    let cart =
        JSON.parse(
            localStorage.getItem("cart")
        ) || [];

    // Cek apakah product sudah ada
    const existingProduct =
        cart.find((item) =>

            item.name === product.name &&
            item.size === product.size &&
            item.color === product.color
        );

    // Tambah qty jika product sudah ada
    if (existingProduct) {

        existingProduct.qty++;

    } else {

        cart.push(product);
    }

    // Simpan cart
    localStorage.setItem(
        "cart",
        JSON.stringify(cart)
    );

    alert("Produk berhasil ditambahkan!");
});

// OTOMATIS BUKA MODAL & SIMPAN PROGRESS SEBELUM PULANG
// ============================================================================
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const productIdFromUrl = urlParams.get('id');
    const asalHalaman = urlParams.get('from');

    // --- 1. LOGIKA OTOMATIS BUKA MODAL DETAIL PRODUK ---
    if (productIdFromUrl) {
        const productCards = document.querySelectorAll('.product-card');
        
        const targetCard = Array.from(productCards).find(card => {
            const cardImageUrl = card.getAttribute('data-image');
            if (cardImageUrl) {
                const imageMapping = {
                    23: 'atscowo1', 24: 'atscowo2', 25: 'atscowo3', 27: 'atscowo4',
                    28: 'bwhcowo1', 29: 'bwhcowo2', 30: 'bwhcowo3', 31: 'bwhcowo4',
                    1: 'atscewe1', 2: 'atscewe2', 3: 'atscewe3', 4: 'atscewe4', 5: 'atscewe5',
                    7: 'bwhcewe1', 10: 'bwhcewe2', 14: 'bwhcewe3', 15: 'bwhcewe4', 16: 'bwhcewe5'
                };
                const keywordGambar = imageMapping[productIdFromUrl];
                if (keywordGambar && cardImageUrl.toLowerCase().includes(keywordGambar.toLowerCase())) {
                    return true;
                }
            }
            return false;
        });

        if (targetCard) {
            setTimeout(() => {
                targetCard.click();
            }, 100);
        }
    }

    // --- 2. KUNCI BARU: LOGIKA TOMBOL CLOSE (X) + SAVE PROGRESS DI KATALOG ---
    const tombolCloseKatalog = document.getElementById('closeBtn');
    const modalOverlay = document.getElementById('overlay-details');

    if (tombolCloseKatalog) {
        tombolCloseKatalog.addEventListener('click', function(e) {
            if (asalHalaman === 'mixmatch') {
                e.preventDefault(); 

                // A. AMBIL DATA PROGRESS YANG SUDAH ADA DI BROWSER DULU
                let currentProgress = { gender: 'male', atasanId: null, bawahanId: null };
                const existingProgress = localStorage.getItem('aktif_mixmatch');
                if (existingProgress) {
                    currentProgress = JSON.parse(existingProgress);
                }

                // B. DETEKSI APAKAH PRODUK YANG SEDANG DILIHAT INI ATASAN ATAU BAWAHAN
                // Kita tebak tipenya berdasarkan ID produk yang ada di URL saat ini
                const idSekarang = parseInt(productIdFromUrl);
                
                // Daftarkan ID mana saja yang termasuk kelompok atasan
                const listIdAtasan = [23, 24, 25, 27, 1, 2, 3, 4, 5]; 

                if (listIdAtasan.includes(idSekarang)) {
                    // Kalau yang dibuka di katalog adalah atasan, update info atasanId
                    currentProgress.atasanId = idSekarang;
                } else {
                    // Kalau bukan atasan, berarti celana/bawahan, update info bawahanId
                    currentProgress.bawahanId = idSekarang;
                }

                // C. SIMPAN MEMORI TERBARU KE LOCALSTORAGE
                localStorage.setItem('aktif_mixmatch', JSON.stringify(currentProgress));
                
                // D. BARU TENDANG USER BALIK KE MIXMATCH
                window.location.href = '/mixmatch'; 
            } else {
                if (modalOverlay) {
                    modalOverlay.style.display = 'none';
                }
            }
        });
    }
});