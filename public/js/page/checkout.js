const checkoutItems   = document.getElementById("checkoutItems");
const subtotalProduct = document.getElementById("subtotalProduct");
const totalProduct    = document.getElementById("totalProduct");
const finalTotal      = document.getElementById("finalTotal");
const shippingCost    = document.getElementById("shippingCost");
const shippingTotal   = document.getElementById("shippingTotal");
const addressBox      = document.getElementById("addressBox");
const payButton       = document.getElementById("pay-button");

let cart    = JSON.parse(localStorage.getItem("checkout")) || [];
let address = JSON.parse(localStorage.getItem("address"));

const SHIPPING_FEE = 15000;

function formatRupiah(number) {
    return "Rp " + number.toLocaleString("id-ID");
}

// RENDER ADDRESS
function renderAddress() {
    if (address) {
        addressBox.innerHTML = `
            <div>
                <strong>${address.name}</strong>
                <p>
                    ${address.phone}<br>
                    ${address.address}<br>
                    ${address.city}, ${address.province}<br>
                    ${address.postal}
                </p>
            </div>
            <img src="/assets/icon/arrow-right.svg">
        `;
    } else {
        addressBox.innerHTML = `
            <p>Add Address</p>
            <img src="/assets/icon/arrow-right.svg">
        `;
    }
}

addressBox.addEventListener("click", () => {
    window.location.href = "/addAddress";
});

// RENDER ITEMS + TOTALS
function renderCheckout() {
    checkoutItems.innerHTML = "";

    if (cart.length === 0) {
        checkoutItems.innerHTML = "<p>Tidak ada produk checkout</p>";
        updateTotals(0);
        return;
    }

    let subtotal = 0;
    cart.forEach((item, index) => {
        subtotal += item.price * item.qty;
        checkoutItems.innerHTML += `
            <div class="order-card">
                <div class="order-image">
                    <img src="${item.image}" alt="${item.name}">
                </div>
                <div class="order-info">
                    <h3>${item.name}</h3>
                    <p>Size: ${item.size}<br>Color: ${item.color}</p>
                    <div class="order-action">
                        <div class="qty-box">
                            <button class="minus-btn" data-index="${index}">-</button>
                            <span>${item.qty}</span>
                            <button class="plus-btn" data-index="${index}">+</button>
                        </div>
                        <button class="delete-btn" data-index="${index}">
                            <img src="/assets/icon/trash.svg">
                        </button>
                    </div>
                </div>
            </div>
        `;
    });

    updateTotals(subtotal);
    initEvents();
}

function updateTotals(subtotal) {
    const grand = subtotal + SHIPPING_FEE;
    subtotalProduct.innerText = formatRupiah(subtotal);
    shippingCost.innerText    = formatRupiah(SHIPPING_FEE);
    shippingTotal.innerText   = formatRupiah(SHIPPING_FEE);
    totalProduct.innerText    = formatRupiah(grand);
    finalTotal.innerText      = formatRupiah(grand);
}

// BUTTON EVENTS
function initEvents() {
    document.querySelectorAll(".plus-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            cart[btn.dataset.index].qty++;
            saveAndRender();
        });
    });

    document.querySelectorAll(".minus-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            if (cart[btn.dataset.index].qty > 1) {
                cart[btn.dataset.index].qty--;
                saveAndRender();
            }
        });
    });

    document.querySelectorAll(".delete-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            cart.splice(btn.dataset.index, 1);
            saveAndRender();
        });
    });
}

function saveAndRender() {
    localStorage.setItem("checkout", JSON.stringify(cart));
    renderCheckout();
}

// PAY
payButton.addEventListener("click", () => {
    if (!address) {
        alert("Silahkan isi alamat terlebih dahulu!");
        return;
    }
    if (cart.length === 0) {
        alert("Checkout kosong!");
        return;
    }

    payButton.disabled    = true;
    payButton.innerText   = "Processing...";

    fetch("/checkout/payment", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ cart, address }),
    })
    .then(res => res.json())
    .then(data => {
        snap.pay(data.snap_token, {
            onSuccess: function () {
                localStorage.removeItem("checkout");
                localStorage.removeItem("cart");
                window.location.href = `/invoice/${data.order_id}`;
            },
            onPending: function () {
                localStorage.removeItem("checkout");
                window.location.href = `/invoice/${data.order_id}`;
            },
            onError: function () {
                alert("Pembayaran gagal, silahkan coba lagi.");
                payButton.disabled  = false;
                payButton.innerText = "Pay Now";
            },
            onClose: function () {
                payButton.disabled  = false;
                payButton.innerText = "Pay Now";
            },
        });
    })
    .catch(err => {
        console.error(err);
        alert("Terjadi kesalahan, coba lagi.");
        payButton.disabled  = false;
        payButton.innerText = "Pay Now";
    });
});

renderAddress();
renderCheckout();