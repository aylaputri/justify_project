const CSRF        = window.CHECKOUT_CSRF || '';
const SHIPPING    = 15000;

function formatRupiah(n) { return 'Rp ' + n.toLocaleString('id-ID'); }

// ─── QTY CONTROLS ────────────────────────────────────────
function recalc() {
    let subtotal = 0;
    document.querySelectorAll('.order-card').forEach(card => {
        const id      = card.dataset.id;
        const qty     = parseInt(document.getElementById('qty-' + id)?.textContent || 0);
        const priceEl = document.getElementById('price-' + id);
        const unit    = parseInt(priceEl?.dataset.unit || 0);
        const line    = unit * qty;
        if (priceEl) priceEl.textContent = formatRupiah(line);
        subtotal += line;
    });
    const grand = subtotal + SHIPPING;
    document.getElementById('subtotalProduct').textContent = formatRupiah(subtotal);
    document.getElementById('totalProduct').textContent    = formatRupiah(grand);
    document.getElementById('finalTotal').textContent      = formatRupiah(grand);
}

document.querySelectorAll('.plus-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id    = btn.dataset.id;
        const stock = parseInt(btn.dataset.stock || 99);
        const cur   = parseInt(document.getElementById('qty-' + id).textContent);
        if (cur >= stock) { alert('Stok habis'); return; }
        const newQty = cur + 1;
        await fetch('/cart/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ id_cart: id, quantity: newQty }),
        });
        document.getElementById('qty-' + id).textContent = newQty;
        btn.dataset.qty = newQty;
        recalc();
    });
});

document.querySelectorAll('.minus-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id  = btn.dataset.id;
        const cur = parseInt(document.getElementById('qty-' + id).textContent);
        if (cur <= 1) return;
        const newQty = cur - 1;
        await fetch('/cart/update', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ id_cart: id, quantity: newQty }),
        });
        document.getElementById('qty-' + id).textContent = newQty;
        recalc();
    });
});

document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const id   = btn.dataset.id;
        const card = btn.closest('.order-card');
        await fetch('/cart/remove', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
            body: JSON.stringify({ id_cart: id }),
        });
        card.remove();
        recalc();
    });
});

// ─── PAY NOW ─────────────────────────────────────────────
const payBtn = document.getElementById('pay-button');
payBtn.addEventListener('click', () => {
    if (!window.HAS_ADDRESS) {
        alert('Silahkan pilih alamat terlebih dahulu!');
        window.location.href = '/address?from=checkout';
        return;
    }

    const cartIds = [...document.querySelectorAll('.order-card')].map(c => c.dataset.id);
    if (cartIds.length === 0) {
        alert('Tidak ada produk untuk di-checkout!');
        return;
    }

    payBtn.disabled  = true;
    payBtn.innerText = 'Processing...';

    // Kirim hanya id_address dan cart_ids — semua data diambil dari DB di server
    fetch('/checkout/payment', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({
            id_address: window.ADDRESS_ID,
            cart_ids:   cartIds,
        }),
    })
    .then(res => {
        if (!res.ok) return res.json().then(e => { throw new Error(e.error || 'Server error'); });
        return res.json();
    })
    .then(data => {
        snap.pay(data.snap_token, {
            onSuccess: () => {
                window.location.href = '/invoice/' + data.order_id;
            },
            onPending: () => {
                window.location.href = '/invoice/' + data.order_id;
            },
            onError: () => {
                alert('Pembayaran gagal, silahkan coba lagi.');
                payBtn.disabled  = false;
                payBtn.innerText = 'Pay Now';
            },
            onClose: () => {
                payBtn.disabled  = false;
                payBtn.innerText = 'Pay Now';
            },
        });
    })
    .catch(err => {
        alert('Error: ' + err.message);
        payBtn.disabled  = false;
        payBtn.innerText = 'Pay Now';
    });
});