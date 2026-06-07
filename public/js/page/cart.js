const CSRF    = window.CART_CSRF || '';
const DELIVERY = 15000;

function formatRupiah(n) {
    return 'Rp ' + n.toLocaleString('id-ID');
}

function getCards() {
    return document.querySelectorAll('.cart-card');
}

// ─── UPDATE TOTAL ────────────────────────────────────────
function updateTotal() {
    let selectedItems = 0, subtotal = 0;
    getCards().forEach(card => {
        const cb = card.querySelector('.cart-check');
        if (cb && cb.checked) {
            const qty   = parseInt(card.querySelector('.qty').textContent);
            const price = parseInt(card.dataset.price);
            selectedItems += qty;
            subtotal      += price * qty;
        }
    });
    document.getElementById('selectedItems').textContent = selectedItems;
    document.getElementById('subtotal').textContent      = formatRupiah(subtotal);
    document.getElementById('totalAmount').textContent   = subtotal > 0 ? formatRupiah(subtotal + DELIVERY) : 'Rp 0';
}

// ─── UPDATE QTY KE SERVER ────────────────────────────────
async function updateQty(card, newQty) {
    const idCart = card.dataset.id;
    await fetch('/cart/update', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ id_cart: idCart, quantity: newQty }),
    });
    card.querySelector('.qty').textContent = newQty;
    updateTotal();
}

// ─── REMOVE DARI SERVER ──────────────────────────────────
async function removeItem(card) {
    const idCart = card.dataset.id;
    await fetch('/cart/remove', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ id_cart: idCart }),
    });
    card.remove();
    updateTotal();
    if (document.querySelectorAll('.cart-card').length === 0) {
        const section = document.getElementById('cartItems');
        section.innerHTML = '<p id="emptyCart">Keranjang masih kosong</p>';
    }
}

// ─── INIT EVENTS ─────────────────────────────────────────
function initEvents() {
    getCards().forEach(card => {
        const cb       = card.querySelector('.cart-check');
        const plusBtn  = card.querySelector('.plus-btn');
        const minusBtn = card.querySelector('.minus-btn');
        const delBtn   = card.querySelector('.delete-btn');
        const stock    = parseInt(card.dataset.stock || 99);

        cb.addEventListener('change', updateTotal);

        plusBtn.addEventListener('click', () => {
            const cur = parseInt(card.querySelector('.qty').textContent);
            if (cur < stock) updateQty(card, cur + 1);
            else alert('Stok habis');
        });

        minusBtn.addEventListener('click', () => {
            const cur = parseInt(card.querySelector('.qty').textContent);
            if (cur > 1) updateQty(card, cur - 1);
        });

        delBtn.addEventListener('click', () => removeItem(card));
    });
}

// ─── CHECKOUT ────────────────────────────────────────────
document.getElementById('checkoutBtn').addEventListener('click', () => {
    const checkedIds = [];
    getCards().forEach(card => {
        const cb = card.querySelector('.cart-check');
        if (cb && cb.checked) checkedIds.push(card.dataset.id);
    });

    if (checkedIds.length === 0) {
        alert('Pilih produk terlebih dahulu!');
        return;
    }

    // Simpan id cart yang dipilih ke session via server
    fetch('/cart/select', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ cart_ids: checkedIds }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) window.location.href = '/checkout';
        else alert('Gagal lanjut checkout');
    })
    .catch(() => alert('Terjadi kesalahan'));
});

initEvents();
updateTotal();