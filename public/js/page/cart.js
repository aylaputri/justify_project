const cartItemsContainer = document.getElementById("cartItems");

const selectedItemsEl = document.getElementById("selectedItems");
const subtotalEl = document.getElementById("subtotal");
const totalAmountEl = document.getElementById("totalAmount");

const checkoutBtn = document.querySelector(".checkout-btn");

const DELIVERY = 15000;

let cart = JSON.parse(localStorage.getItem("cart")) || [];

// FORMAT RUPIAH
function formatRupiah(number){

    return "Rp " + number.toLocaleString("id-ID");

}

// RENDER CART
function renderCart(){

    cartItemsContainer.innerHTML = "";

    if(cart.length === 0){

        cartItemsContainer.innerHTML = `
            <p>Keranjang masih kosong</p>
        `;

        updateCart();

        return;
    }

    cart.forEach((item, index) => {

        cartItemsContainer.innerHTML += `
        
        <div class="cart-card" data-index="${index}">

            <input type="checkbox" class="cart-check">

            <div class="cart-image">
                <img src="${item.image}">
            </div>

            <div class="cart-info">

                <h3>${item.name}</h3>

                <p>${formatRupiah(item.price)}</p>

                <small>
                    Size: ${item.size} |
                    Color: ${item.color}
                </small>

                <div class="cart-action">

                    <div class="qty-box">

                        <button class="minus-btn">-</button>

                        <span class="qty">${item.qty}</span>

                        <button class="plus-btn">+</button>

                    </div>

                    <button class="delete-btn">
                        <img src="/assets/icon/trash.svg">
                    </button>

                </div>

            </div>

        </div>
        `;
    });

    initEvents();
}

// UPDATE TOTAL
function updateCart(){

    const cards = document.querySelectorAll(".cart-card");

    let selectedItems = 0;
    let subtotal = 0;

    cards.forEach(card => {

        const checkbox = card.querySelector(".cart-check");

        if(checkbox.checked){

            const index = card.dataset.index;

            const item = cart[index];

            selectedItems += item.qty;

            subtotal += item.price * item.qty;
        }

    });

    selectedItemsEl.innerText = selectedItems;

    subtotalEl.innerText = formatRupiah(subtotal);

    if(subtotal > 0){

        totalAmountEl.innerText =
            formatRupiah(subtotal + DELIVERY);

    } else {

        totalAmountEl.innerText = "Rp 0";

    }
}

// EVENTS
function initEvents(){

    const cards = document.querySelectorAll(".cart-card");

    cards.forEach(card => {

        const index = card.dataset.index;

        const checkbox = card.querySelector(".cart-check");

        const plusBtn = card.querySelector(".plus-btn");

        const minusBtn = card.querySelector(".minus-btn");

        const deleteBtn = card.querySelector(".delete-btn");

        // CHECKBOX
        checkbox.addEventListener("change", updateCart);

        // PLUS
        plusBtn.addEventListener("click", () => {

            cart[index].qty++;

            localStorage.setItem(
                "cart",
                JSON.stringify(cart)
            );

            renderCart();
        });

        // MINUS
        minusBtn.addEventListener("click", () => {

            if(cart[index].qty > 1){

                cart[index].qty--;

                localStorage.setItem(
                    "cart",
                    JSON.stringify(cart)
                );

                renderCart();
            }
        });

        // DELETE
        deleteBtn.addEventListener("click", () => {

            cart.splice(index, 1);

            localStorage.setItem(
                "cart",
                JSON.stringify(cart)
            );

            renderCart();
        });

    });

    updateCart();
}

// CHECKOUT
checkoutBtn.addEventListener("click", () => {

    const checkedItems = [];

    const cards = document.querySelectorAll(".cart-card");

    cards.forEach(card => {

        const checkbox = card.querySelector(".cart-check");

        if(checkbox.checked){

            const index = card.dataset.index;

            checkedItems.push(cart[index]);
        }
    });

    // KALO GA ADA YG DIPILIH
    if(checkedItems.length === 0){

        alert("Pilih produk terlebih dahulu!");

        return;
    }

    // SIMPAN KE CHECKOUT
    localStorage.setItem(
        "checkout",
        JSON.stringify(checkedItems)
    );

    // PINDAH HALAMAN
    window.location.href = "/checkout";
});

renderCart();