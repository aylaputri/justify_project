const sortingSelect = document.getElementById("sorting");
const kategori = document.getElementById("kategori");
const size = document.getElementById("size");
const colors = document.getElementById("colors");

const resetFilter = document.getElementById("resetFilter");

const searchInputs = document.querySelectorAll(".search-box input, #search");

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

let selectedSize = null;
let selectedColor = null;

/*  FILTER URL */
function updateFilter() {
    const url = new URL(window.location.href);

    // Kategori
    if (kategori.value) {
        url.searchParams.set("kategori", kategori.value);
    } else {
        url.searchParams.delete("kategori");
    }

    // Size
    if (size.value) {
        url.searchParams.set("size", size.value);
    } else {
        url.searchParams.delete("size");
    }

    // Colors
    if (colors.value) {
        url.searchParams.set("colors", colors.value);
    } else {
        url.searchParams.delete("colors");
    }

    // Sorting
    if (sortingSelect.value) {
        url.searchParams.set("sorting", sortingSelect.value);
    } else {
        url.searchParams.delete("sorting");
    }

    window.location.href = url;
}

sortingSelect.addEventListener("change", updateFilter);
kategori.addEventListener("change", updateFilter);
size.addEventListener("change", updateFilter);
colors.addEventListener("change", updateFilter);

/* REALTIME SEARCH */
searchInputs.forEach((input) => {
    input.addEventListener("input", () => {
        const keyword = input.value.toLowerCase().trim();

        // Sinkronisasi teks ketikan ke seluruh kolom search di halaman
        searchInputs.forEach((otherInput) => {
            otherInput.value = input.value;
        });

        // Filter kartu produk secara realtime
        cards.forEach((card) => {
            const productName = (card.dataset.name || "").toLowerCase();
            const category = (card.dataset.category || "").toLowerCase();
            const description = (card.dataset.description || "").toLowerCase();

            const isMatch =
                productName.includes(keyword) ||
                category.includes(keyword) ||
                description.includes(keyword);

            card.style.display = isMatch ? "block" : "none";
        });
    });
});

/* OPEN MODAL & RENDER VARIATION */
cards.forEach((card) => {
    card.addEventListener("click", () => {
        selectedSize = null;
        selectedColor = null;

        // Isi data utama modal dari dataset kartu yang diklik
        modalName.innerText = card.dataset.name;
        modalPrice.innerText = "Rp " + card.dataset.price;
        modalCategory.innerText = card.dataset.category;
        modalDescription.innerText = card.dataset.description;
        modalImage.src = card.dataset.image;

        // --- Render Pilihan Ukuran (Sizes) ---
        modalSizes.innerHTML = "";
        const sizes = card.dataset.sizes ? card.dataset.sizes.split(",") : [];

        sizes.forEach((sizeItem) => {
            const span = document.createElement("span");
            span.innerText = sizeItem;

            span.addEventListener("click", (e) => {
                // Hentikan gelembung event agar modal tidak tertutup otomatis
                e.stopPropagation(); 

                document
                    .querySelectorAll("#modalSizes span")
                    .forEach((s) => s.classList.remove("active"));

                span.classList.add("active");
                selectedSize = sizeItem;
            });

            modalSizes.appendChild(span);
        });

        // --- Render Pilihan Warna (Colors) ---
        modalColors.innerHTML = "";
        const colorList = card.dataset.colors ? card.dataset.colors.split(",") : [];

        colorList.forEach((colorItem) => {
            const span = document.createElement("span");
            span.innerText = colorItem;

            span.addEventListener("click", (e) => {
                // Hentikan gelembung event agar modal tidak tertutup otomatis
                e.stopPropagation();

                document
                    .querySelectorAll("#modalColors span")
                    .forEach((c) => c.classList.remove("active"));

                span.classList.add("active");
                selectedColor = colorItem;
            });

            modalColors.appendChild(span);
        });

        // Tampilkan Modal
        details.classList.add("active");
    });
});

/*  CLOSE MODAL */
closeBtn.addEventListener("click", () => {
    details.classList.remove("active");
});

// Tutup modal hanya jika area backdrop hitam kosong di luar modal yang diklik
details.addEventListener("click", (e) => {
    if (e.target === details) {
        details.classList.remove("active");
    }
});

// Mengamankan elemen internal modal dari penutupan tidak sengaja
const modalBox = document.querySelector(".modal");
if (modalBox) {
    modalBox.addEventListener("click", (e) => {
        e.stopPropagation();
    });
}

/* CHECKOUT ACTION */
checkoutBtn.addEventListener("click", (e) => {
    e.preventDefault();

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

    localStorage.setItem("checkout", JSON.stringify([product]));
    window.location.href = "/checkout";
});

/*  ADD TO CART ACTION */
cartBtn.addEventListener("click", (e) => {
    e.preventDefault();

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

    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const existingProduct = cart.find(
        (item) =>
            item.name === product.name &&
            item.size === product.size &&
            item.color === product.color
    );

    if (existingProduct) {
        existingProduct.qty++;
    } else {
        cart.push(product);
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    alert("Produk berhasil ditambahkan!");
});