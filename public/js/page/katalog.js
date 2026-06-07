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

const checkoutBtn      = document.getElementById("checkoutBtn");
const cartBtn          = document.querySelector(".cart-btn");
const userHeight      = document.getElementById("userHeight");
const userWeight      = document.getElementById("userWeight");
const recommendedSize = document.getElementById("recommendedSize");

const CSRF = document.querySelector('meta[name="csrf-token"]')
    ? document.querySelector('meta[name="csrf-token"]').getAttribute("content")
    : "";

const urlParams    = new URLSearchParams(window.location.search);
const fromPage     = urlParams.get("from");
const productIdUrl = urlParams.get("id");

let selectedSize      = null;
let selectedColor     = null;
let currentSizeCharts = [];
let currentVariants   = [];

function getSelectedVariantId() {
    if (!selectedSize || !selectedColor) return null;
    const match = currentVariants.find(
        (v) => v.size === selectedSize && v.color === selectedColor
    );
    return match ? match.id : null;
}

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
    if (fromPage) url.searchParams.set("from", fromPage);
    if (productIdUrl) url.searchParams.set("id", productIdUrl);
    window.location.href = url;
}

sortingSelect.addEventListener("change", updateFilter);
kategori.addEventListener("change", updateFilter);
size.addEventListener("change", updateFilter);
colors.addEventListener("change", updateFilter);

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

function openModal(card) {
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

    const sizeChartBody = document.getElementById("sizeChartBody");
    if (sizeChartBody) {
        sizeChartBody.innerHTML = "";
        currentSizeCharts.forEach((chart) => {
            sizeChartBody.innerHTML += `
                <tr>
                    <td>${chart.size}</td>
                    <td>${chart.length_cm}</td>
                    <td>${chart.width_cm}</td>
                </tr>`;
        });
    }

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
    details.style.display = "flex"; // Memastikan container overlay terlihat instan
}

cards.forEach((card) => {
    card.addEventListener("click", () => openModal(card));
});

// ==================== LOGIKA CLOSE MODAL DAN REDIRECT (DAN SAVE PROGRESS) ====================
function closeModal() {
    if (details) {
        details.classList.remove("active");
        details.style.display = "none";
    }

    if (fromPage === "mixmatch" && productIdUrl) {
        let currentProgress = { gender: 'male', atasanId: null, bawahanId: null };
        const existingProgress = localStorage.getItem('aktif_mixmatch');
        if (existingProgress) {
            currentProgress = JSON.parse(existingProgress);
        }

        const idSekarang = parseInt(productIdUrl);
        // Gabungan list id atasan terlengkap dari kedua skrip kamu
        const listIdAtasan = [23, 24, 25, 26, 27, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 12, 13];
        
        if (listIdAtasan.includes(idSekarang)) {
            currentProgress.atasanId = idSekarang;
        } else {
            currentProgress.bawahanId = idSekarang;
        }

        localStorage.setItem('aktif_mixmatch', JSON.stringify(currentProgress));
        window.location.href = '/mixmatch';
    }
}

if (closeBtn) closeBtn.addEventListener("click", closeModal);
if (details) {
    details.addEventListener("click", (e) => {
        if (e.target === details) closeModal();
    });
}
const modalBox = document.querySelector(".modal");
if (modalBox) modalBox.addEventListener("click", (e) => e.stopPropagation());

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
if (userHeight) userHeight.addEventListener("input", calculateSmartSize);
if (userWeight) userWeight.addEventListener("input", calculateSmartSize);

// ==================== GLOBAL INITIALIZATION (DOMContentLoaded) ====================
document.addEventListener("DOMContentLoaded", function() {
    // Jalankan auto-buka jika parameter lengkap dideteksi saat halaman selesai dimuat
    if (productIdUrl) {
        // Metode 1: Cari berdasarkan dataset ID murni (Prioritas Utama)
        let targetCard = Array.from(cards).find(
            (card) => String(card.dataset.productId || card.dataset.id) === String(productIdUrl)
        );

        // Metode 2: Cadangan pencarian lewat kata kunci nama file gambar (Fallback)
        if (!targetCard) {
            targetCard = Array.from(cards).find(card => {
                const cardImageUrl = card.getAttribute('data-image');
                if (cardImageUrl) {
                    const imageMapping = {
                        23: 'atscowo1', 24: 'atscowo2', 25: 'atscowo3', 27: 'atscowo4',
                        28: 'bwhcowo1', 29: 'bwhcowo2', 30: 'bwhcowo3', 31: 'bwhcowo4',
                        1: 'atscewe1', 2: 'atscewe2', 3: 'atscewe3', 4: 'atscewe4', 5: 'atscewe5',
                        7: 'bwhcewe1', 10: 'bwhcewe2', 14: 'bwhcewe3', 15: 'bwhcewe4', 16: 'bwhcewe5'
                    };
                    const keywordGambar = imageMapping[productIdUrl];
                    return keywordGambar && cardImageUrl.toLowerCase().includes(keywordGambar.toLowerCase());
                }
                return false;
            });
        }

        if (targetCard) {
            setTimeout(() => openModal(targetCard), 100);
        }
    }
});

// ==================== TOMBOL CART & CHECKOUT ACTION ====================
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
            if (details) {
                details.classList.remove("active");
                details.style.display = "none";
            }
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
        const addRes  = await fetch("/cart/add", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": CSRF },
            body: JSON.stringify({ id_variant: variantId, quantity: 1 }),
        });
        const addData = await addRes.json();
        if (!addData.success) {
            alert(addData.message || "Gagal menambahkan ke keranjang.");
            return;
        }
        const cartRes  = await fetch("/cart/get-id?id_variant=" + variantId, {
            headers: { "X-CSRF-TOKEN": CSRF },
        });
        const cartData = await cartRes.json();
        if (!cartData.id_cart) {
            window.location.href = "/cart";
            return;
        }
        const selectRes  = await fetch("/cart/select", {
            method: "POST",
            headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": CSRF },
            body: JSON.stringify({ cart_ids: [cartData.id_cart] }),
        });
        const selectData = await selectRes.json();
        window.location.href = selectData.success ? "/checkout" : "/cart";
    } catch (err) {
        console.error(err);
        alert("Terjadi kesalahan. Coba lagi.");
    }
});