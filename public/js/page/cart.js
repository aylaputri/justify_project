const cartCards = document.querySelectorAll('.cart-card');

const selectedItemsEl = document.getElementById('selectedItems');
const subtotalEl = document.getElementById('subtotal');
const totalAmountEl = document.getElementById('totalAmount');

const DELIVERY = 15000;

// FORMAT RUPIAH
function formatRupiah(number){
    return 'Rp ' + number.toLocaleString('id-ID');
}

// UPDATE TOTAL
function updateCart(){

    let selectedItems = 0;
    let subtotal = 0;

    cartCards.forEach(card => {

        const checkbox = card.querySelector('.cart-check');
        const qtyEl = card.querySelector('.qty');

        const qty = parseInt(qtyEl.innerText);
        const price = parseInt(card.dataset.price);

        if(checkbox.checked){

            selectedItems += qty;
            subtotal += price * qty;

        }

    });

    const total = subtotal + DELIVERY;

    selectedItemsEl.innerText = selectedItems;
    subtotalEl.innerText = formatRupiah(subtotal);

    if(subtotal > 0){
        totalAmountEl.innerText = formatRupiah(total);
    } else {
        totalAmountEl.innerText = 'Rp 0';
    }

}

// LOOP CARD
cartCards.forEach(card => {

    const checkbox = card.querySelector('.cart-check');

    const minusBtn = card.querySelector('.minus-btn');
    const plusBtn = card.querySelector('.plus-btn');

    const qtyEl = card.querySelector('.qty');

    const deleteBtn = card.querySelector('.delete-btn');

    // CHECKBOX
    checkbox.addEventListener('change', updateCart);

    // PLUS
    plusBtn.addEventListener('click', () => {

        let qty = parseInt(qtyEl.innerText);

        qty++;

        qtyEl.innerText = qty;

        updateCart();

    });

    // MINUS
    minusBtn.addEventListener('click', () => {

        let qty = parseInt(qtyEl.innerText);

        if(qty > 1){

            qty--;

            qtyEl.innerText = qty;

            updateCart();

        }

    });

    // DELETE
    deleteBtn.addEventListener('click', () => {

        card.remove();

        updateCart();

    });

});

// PERTAMA KALI
updateCart();