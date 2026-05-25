const sortingSelect = document.getElementById("sorting");
const kategori = document.getElementById("kategori");
const size = document.getElementById("size");
const colors = document.getElementById("colors");

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


function updateFilter() {

    const url = new URL(window.location.href);

    // kategori
    if (kategori.value) {
        url.searchParams.set("kategori", kategori.value);
    } else {
        url.searchParams.delete("kategori");
    }

    // size
    if (size.value) {
        url.searchParams.set("size", size.value);
    } else {
        url.searchParams.delete("size");
    }

    // colors
    if (colors.value) {
        url.searchParams.set("colors", colors.value);
    } else {
        url.searchParams.delete("colors");
    }

    // sorting
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

// BUKA MODAL
cards.forEach((card) => {
    card.addEventListener("click", () => {

        selectedSize = null;
        selectedColor = null;

        modalName.innerText = card.dataset.name;
        modalPrice.innerText = "Rp " + card.dataset.price;
        modalCategory.innerText = card.dataset.category;
        modalDescription.innerText = card.dataset.description;
        modalImage.src = card.dataset.image;

        // SIZE
        modalSizes.innerHTML = "";

        const sizes = card.dataset.sizes.split(",");

        sizes.forEach((size) => {

            const span = document.createElement("span");

            span.innerText = size;

            span.addEventListener("click", () => {

                document
                    .querySelectorAll("#modalSizes span")
                    .forEach(s => s.classList.remove("active"));

                span.classList.add("active");

                selectedSize = size;
            });

            modalSizes.appendChild(span);
        });

        // COLOR
        modalColors.innerHTML = "";

        const colors = card.dataset.colors.split(",");

        colors.forEach((color) => {

            const span = document.createElement("span");

            span.innerText = color;

            span.addEventListener("click", () => {

                document
                    .querySelectorAll("#modalColors span")
                    .forEach(c => c.classList.remove("active"));

                span.classList.add("active");

                selectedColor = color;
            });

            modalColors.appendChild(span);
        });

        details.style.display = "flex";
    });
});

// TUTUP MODAL
closeBtn.addEventListener("click", () => {
    details.style.display = "none";
});

// VALIDASI CHECKOUT
checkoutBtn.addEventListener("click", (e) => {

    if (!selectedSize || !selectedColor) {

        e.preventDefault();

        alert("Pilih size dan warna terlebih dahulu!");
    }
});

// VALIDASI CART
cartBtn.addEventListener("click", (e) => {

    e.preventDefault();

    if (!selectedSize || !selectedColor) {

        alert("Pilih size dan warna terlebih dahulu!");

        return;
    }

    alert(
        "Produk berhasil ditambahkan!\n" +
        "Size: " + selectedSize +
        "\nWarna: " + selectedColor
    );
});