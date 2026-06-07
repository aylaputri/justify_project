const sortingSelect = document.getElementById("sorting");
const kategori      = document.getElementById("kategori");
const size          = document.getElementById("size");
const colors        = document.getElementById("colors");
const searchInputs  = document.querySelectorAll(".search-box input");

const cards      = document.querySelectorAll(".product-card");
const details    = document.getElementById("overlay-details");
const closeBtn   = document.getElementById("closeBtn");

const modalName        = document.getElementById("modalName");
const modalPrice       = document.getElementById("modalPrice");
const modalCategory    = document.getElementById("modalCategory");
const modalDescription = document.getElementById("modalDescription");
const modalImage       = document.getElementById("modalImage");
const modalSizes       = document.getElementById("modalSizes");
const modalColors      = document.getElementById("modalColors");

const checkoutBtn    = document.getElementById("checkoutBtn");
const cartBtn        = document.querySelector(".cart-btn");
const userHeight     = document.getElementById("userHeight");
const userWeight     = document.getElementById("userWeight");
const recommendedSize = document.getElementById("recommendedSize");

const CSRF = document.querySelector('meta[name="csrf-token"]')
    ? document.querySelector('meta[name="csrf-token"]').getAttribute("content")
    : "";

let selectedSize     = null;
let selectedColor    = null;
let currentSizeCharts = [];
let currentVariants  = [];

function getSelectedVariantId() {
    if (!selectedSize || !selectedColor) return null;
    const match = currentVariants.find(
        (v) => v.size === selectedSize && v.color === selectedColor
    );
    return match ? match.id : null;
}

// ─── FILTER ──────────────────────────────────────────────────────
function updateFilter() {
    const url = new URL(window.location.href);
    if (kategori.value) url.searchParams.set("kategori", kategori.value);
    else url.searchParams.delete("kategori");
    if (size.value) url.searchParams.set("size", size.value);
    else url.searchParams.delete("size");
    if (colors.value) url.searchParams.set("colors", colors.value);
    else url.searchParams.delete("colors");
    if (sortingSelect.value) url.searchParams.set("sorting", sortingSelect.value);
    else url.searchParams.delete("sorting");
    window.location.href = url;
}

sortingSelect.addEventListener("change", updateFilter);
kategori.addEventListener("change", updateFilter);
size.addEventListener("change", updateFilter);
colors.addEventListener("change", updateFilter);

// ─── SEARCH REALTIME ─────────────────────────────────────────────
searchInputs.forEach((input) => {
    input.addEventListener("input", () => {
        const keyword = input.value.toLowerCase().trim();
        searchInputs.forEach((other) => { other.value = input.value; });
        cards.forEach((card) => {
            const name = (card.dataset.name || "").toLowerCase();
            const cat  = (card.dataset.category || "").toLowerCase();
            const desc = (card.dataset.description || "").toLowerCase();
            card.style.display =
                name.includes(keyword) || cat.includes(keyword) || desc.includes(keyword)
                    ? "block" : "none";
        });
    });
});

// ─── OPEN MODAL ──────────────────────────────────────────────────
cards.forEach((card) => {
    card.addEventListener("click", () => {
        selectedSize  = null;
        selectedColor = null;
        recommendedSize.innerText = "-";
        if (userHeight) userHeight.value = "";
        if (userWeight) userWeight.value = "";

        modalName.innerText        = card.dataset.name;
        modalPrice.innerText       = "Rp " + card.dataset.price;
        modalCategory.innerText    = card.dataset.category;
        modalDescription.innerText = card.dataset.description;
        modalImage.src             = card.dataset.image;

        currentVariants   = JSON.parse(card.dataset.variants || "[]");
        currentSizeCharts = JSON.parse(card.dataset.sizecharts || "[]");

        // Size chart
        const sizeChartBody = document.getElementById("sizeChartBody");
        sizeChartBody.innerHTML = "";
        currentSizeCharts.forEach((chart) => {
            sizeChartBody.innerHTML += `
                <tr>
                    <td>${chart.size}</td>
                    <td>${chart.length_cm}</td>
                    <td>${chart.width_cm}</td>
                </tr>`;
        });

        // Sizes
        modalSizes.innerHTML = "";
        const uniqueSizes = [...new Set(currentVariants.map((v) => v.size))];
        uniqueSizes.forEach((sizeItem) => {
            const span = document.createElement("span");
            span.innerText = sizeItem;
            span.addEventListener("click", (e) => {
                e.stopPropagation();
                document.querySelectorAll("#modalSizes span").forEach((s) => s.classList.remove("active"));
                span.classList.add("active");
                selectedSize = sizeItem;
            });
            modalSizes.appendChild(span);
        });

        // Colors
        modalColors.innerHTML = "";
        const uniqueColors = [...new Set(currentVariants.map((v) => v.color))];
        uniqueColors.forEach((colorItem) => {
            const span = document.createElement("span");
            span.innerText = colorItem;
            span.addEventListener("click", (e) => {
                e.stopPropagation();
                document.querySelectorAll("#modalColors span").forEach((c) => c.classList.remove("active"));
                span.classList.add("active");
                selectedColor = colorItem;
            });
            modalColors.appendChild(span);
        });

        details.classList.add("active");
    });
});

// ─── TUTUP MODAL ─────────────────────────────────────────────────
closeBtn.addEventListener("click", () => details.classList.remove("active"));
details.addEventListener("click", (e) => {
    if (e.target === details) details.classList.remove("active");
});
const modalBox = document.querySelector(".modal");
if (modalBox) modalBox.addEventListener("click", (e) => e.stopPropagation());

// ─── SMART SIZING ─────────────────────────────────────────────────
function calculateSmartSize() {
    const height = parseInt(userHeight.value);
    const weight = parseInt(userWeight.value);
    if (!height || !weight) { recommendedSize.innerText = "-"; return; }
    let recommended;
    if (height <= 165 && weight <= 55)      recommended = "S";
    else if (height <= 170 && weight <= 65) recommended = "M";
    else if (height <= 175 && weight <= 75) recommended = "L";
    else                                    recommended = "XL";
    recommendedSize.innerText = recommended;
    document.querySelectorAll("#modalSizes span").forEach((s) => {
        s.classList.remove("active");
        if (s.innerText === recommended) { s.classList.add("active"); selectedSize = recommended; }
    });
}
userHeight.addEventListener("input", calculateSmartSize);
userWeight.addEventListener("input", calculateSmartSize);

// ─── TAMBAH KE CART ───────────────────────────────────────────────
cartBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    if (!selectedSize || !selectedColor) {
        alert("Pilih size dan warna terlebih dahulu!");
        return;
    }

    const variantId = getSelectedVariantId();
    if (!variantId) {
        alert("Kombinasi size dan warna ini tidak tersedia.");
        return;
    }

    try {
        const res  = await fetch("/cart/add", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": CSRF },
            body: JSON.stringify({ id_variant: variantId, quantity: 1 }),
        });
        const data = await res.json();

        if (data.success) {
            alert("Produk berhasil ditambahkan ke keranjang!");
            details.classList.remove("active");
            const cartCount = document.querySelector(".cart-count");
            if (cartCount) cartCount.textContent = data.cart_count;
        } else {
            alert(data.message || "Gagal menambahkan ke keranjang.");
        }
    } catch (err) {
        console.error(err);
        alert("Terjadi kesalahan. Coba lagi.");
    }
});

// ─── CHECKOUT LANGSUNG DARI KATALOG ──────────────────────────────
checkoutBtn.addEventListener("click", async (e) => {
    e.preventDefault();

    if (!selectedSize || !selectedColor) {
        alert("Pilih size dan warna terlebih dahulu!");
        return;
    }

    const variantId = getSelectedVariantId();
    if (!variantId) {
        alert("Kombinasi size dan warna ini tidak tersedia.");
        return;
    }

    try {
        // 1. Tambah ke cart dulu
        const addRes  = await fetch("/cart/add", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": CSRF },
            body: JSON.stringify({ id_variant: variantId, quantity: 1 }),
        });
        const addData = await addRes.json();

<<<<<<< HEAD
        if (!addData.success) {
            alert(addData.message || "Gagal menambahkan ke keranjang.");
            return;
        }

        // 2. Ambil id_cart untuk variant ini
        const cartRes  = await fetch("/cart/get-id?id_variant=" + variantId, {
            headers: { "X-CSRF-TOKEN": CSRF },
        });
        const cartData = await cartRes.json();

        if (!cartData.id_cart) {
            window.location.href = "/cart";
            return;
        }

        // 3. Set ke session sebagai item checkout
        const selectRes  = await fetch("/cart/select", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": CSRF },
            body: JSON.stringify({ cart_ids: [cartData.id_cart] }),
        });
        const selectData = await selectRes.json();

        if (selectData.success) {
            window.location.href = "/checkout";
        } else {
            window.location.href = "/cart";
        }
    } catch (err) {
        console.error(err);
        alert("Terjadi kesalahan. Coba lagi.");
=======
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
>>>>>>> 39bfc4217f96ccdb641ce6828d7589f63577cf9e
    }
});