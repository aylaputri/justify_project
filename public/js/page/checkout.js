const checkoutItems = document.getElementById("checkoutItems");

const subtotalProduct = document.getElementById("subtotalProduct");
const totalProduct = document.getElementById("totalProduct");
const finalTotal = document.getElementById("finalTotal");

const addressBox = document.getElementById("addressBox");

const payButton = document.getElementById("pay-button");

let cart = JSON.parse(localStorage.getItem("checkout")) || [];

let address = JSON.parse(localStorage.getItem("address"));

// FORMAT RUPIAH
function formatRupiah(number){

    return "Rp " + number.toLocaleString("id-ID");
}


// RENDER ADDRESS
function renderAddress(){

    if(address){

        addressBox.innerHTML = `
        
            <div>

                <strong>${address.name}</strong>

                <p>
                    ${address.phone}
                    <br>
                    ${address.address}
                    <br>
                    ${address.city}, ${address.province}
                    <br>
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


// PINDAH KE ADD ADDRESS
addressBox.addEventListener("click", () => {

    window.location.href = "/addAddress";
});


// RENDER CHECKOUT
function renderCheckout(){

    checkoutItems.innerHTML = "";

    if(cart.length === 0){

        checkoutItems.innerHTML = `
            <p>Tidak ada produk checkout</p>
        `;

        return;
    }

    let subtotal = 0;

    cart.forEach((item, index) => {

        subtotal += item.price * item.qty;

        checkoutItems.innerHTML += `
        
        <div class="order-card">

            <div class="order-image">

                <img src="${item.image}">

            </div>

            <div class="order-info">

                <h3>${item.name}</h3>

                <p>
                    Size: ${item.size}
                    <br>
                    Color: ${item.color}
                </p>

                <div class="order-action">

                    <div class="qty-box">

                        <button class="minus-btn" data-index="${index}">
                            -
                        </button>

                        <span>${item.qty}</span>

                        <button class="plus-btn" data-index="${index}">
                            +
                        </button>

                    </div>

                    <button class="delete-btn" data-index="${index}">

                        <img src="/assets/icon/trash.svg">

                    </button>

                </div>

            </div>

        </div>
        `;
    });

    subtotalProduct.innerText = formatRupiah(subtotal);

    totalProduct.innerText = formatRupiah(subtotal);

    finalTotal.innerText = formatRupiah(subtotal);

    initEvents();
}


// BUTTON EVENTS
function initEvents(){

    // PLUS
    document.querySelectorAll(".plus-btn")
    .forEach(btn => {

        btn.addEventListener("click", () => {

            const index = btn.dataset.index;

            cart[index].qty++;

            localStorage.setItem(
                "checkout",
                JSON.stringify(cart)
            );

            renderCheckout();
        });
    });

    // MINUS
    document.querySelectorAll(".minus-btn")
    .forEach(btn => {

        btn.addEventListener("click", () => {

            const index = btn.dataset.index;

            if(cart[index].qty > 1){

                cart[index].qty--;

                localStorage.setItem(
                    "checkout",
                    JSON.stringify(cart)
                );

                renderCheckout();
            }
        });
    });

    // DELETE
    document.querySelectorAll(".delete-btn")
    .forEach(btn => {

        btn.addEventListener("click", () => {

            const index = btn.dataset.index;

            cart.splice(index, 1);

            localStorage.setItem(
                "checkout",
                JSON.stringify(cart)
            );

            renderCheckout();
        });
    });
}


// PAY
payButton.addEventListener("click", () => {

    if(!address){

        alert("Silahkan isi alamat terlebih dahulu!");
        return;
    }

    if(cart.length === 0){

        alert("Checkout kosong!");
        return;
    }

    fetch("/checkout/payment", {

        method: "POST",

        headers: {

            "Content-Type": "application/json",

            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },

        body: JSON.stringify({

            cart: cart,
            address: address
        })

    })

    .then(response => response.json())

    .then(data => {

        snap.pay(data.snap_token, {

            onSuccess: function(result){

                alert("Pembayaran berhasil!");

                console.log(result);

                localStorage.removeItem("checkout");
            },

            onPending: function(result){

                alert("Menunggu pembayaran");

                console.log(result);
            },

            onError: function(result){

                alert("Pembayaran gagal");

                console.log(result);
            }
        });

    })

    .catch(error => {

        console.log(error);

        alert("Terjadi kesalahan");
    });
});

renderAddress();

renderCheckout();