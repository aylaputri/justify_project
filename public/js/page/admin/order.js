const overlay     = document.getElementById('orderModalOverlay');
const closeBtn    = document.getElementById('closeOrderModal');
const cancelBtn   = document.getElementById('cancelOrderModal');
const saveBtn     = document.getElementById('saveOrderBtn');
const orderStatus = document.getElementById('orderStatus');
const orderResi   = document.getElementById('orderResi');
const orderIdInput = document.getElementById('orderId');
const statusFilter = document.getElementById('statusFilter');

// Buka modal saat klik resi
document.querySelectorAll('.resi-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        orderIdInput.value    = this.dataset.id;
        orderStatus.value     = this.dataset.status;
        orderResi.value       = this.dataset.resi;
        overlay.classList.add('active');
    });
});

// Tutup modal
function closeModal() { overlay.classList.remove('active'); }
closeBtn.addEventListener('click', closeModal);
cancelBtn.addEventListener('click', closeModal);
overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });

// Simpan update
saveBtn.addEventListener('click', () => {
    const id = orderIdInput.value;

    fetch(`${UPDATE_URL}/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF_TOKEN,
            'X-HTTP-Method-Override': 'PUT',
        },
        body: JSON.stringify({
            status:           orderStatus.value,
            tracking_number:  orderResi.value,
            _method:          'PUT',
        })
    })
    .then(res => {
        if (res.ok || res.redirected) {
            closeModal();
            location.reload();
        }
    })
    .catch(err => console.error(err));
});

// Filter by status
statusFilter.addEventListener('change', function () {
    const val  = this.value.toLowerCase();
    const rows = document.querySelectorAll('#ordersTable tbody tr');
    rows.forEach(row => {
        if (!val || row.dataset.status.toLowerCase() === val) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Export CSV
function exportCSV() {
    const rows   = document.querySelectorAll('#ordersTable tr');
    const csv    = [];
    rows.forEach(row => {
        const cols = row.querySelectorAll('th, td');
        const data = Array.from(cols).map(c => `"${c.innerText.trim()}"`);
        csv.push(data.join(','));
    });
    const blob = new Blob([csv.join('\n')], { type: 'text/csv' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = 'orders.csv';
    a.click();
    URL.revokeObjectURL(url);
}