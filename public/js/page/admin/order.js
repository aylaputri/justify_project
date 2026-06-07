document.addEventListener('DOMContentLoaded', function () {

    // =====================
    // FILTER BY STATUS
    // =====================
    document.getElementById('statusFilter').addEventListener('change', function () {
        const val = this.value.toLowerCase();
        document.querySelectorAll('#ordersTable tbody tr[data-status]').forEach(row => {
            row.style.display = (!val || row.dataset.status.toLowerCase() === val) ? '' : 'none';
        });
    });

    // =====================
    // MODAL OPEN
    // =====================
    document.querySelectorAll('.resi-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('orderId').value     = this.dataset.id;
            document.getElementById('orderStatus').value = this.dataset.status;
            document.getElementById('orderResi').value   = this.dataset.resi;
            document.getElementById('orderModalOverlay').classList.add('active');
        });
    });

    // =====================
    // MODAL CLOSE
    // =====================
    function closeModal() {
        document.getElementById('orderModalOverlay').classList.remove('active');
    }
    document.getElementById('closeOrderModal').addEventListener('click', closeModal);
    document.getElementById('cancelOrderModal').addEventListener('click', closeModal);
    document.getElementById('orderModalOverlay').addEventListener('click', function (e) {
        if (e.target === this) closeModal();
    });

    // =====================
    // SAVE
    // =====================
    document.getElementById('saveOrderBtn').addEventListener('click', function () {
        const id     = document.getElementById('orderId').value;
        const status = document.getElementById('orderStatus').value;
        const resi   = document.getElementById('orderResi').value.trim();
        const btn    = this;

        btn.textContent = 'Menyimpan...';
        btn.disabled    = true;

        fetch(UPDATE_URL + '/' + id, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
            },
            body: JSON.stringify({ status, tracking_number: resi }),
        })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                const row = document.querySelector(`.resi-btn[data-id="${id}"]`)?.closest('tr');
                if (row) {
                    row.dataset.status = status;
                    const badge = row.querySelector('.status-badge');
                    if (badge) {
                        badge.className   = 'status-badge status-' + status.toLowerCase().replace(/ /g, '-');
                        badge.textContent = status;
                    }
                    const resiBtn = row.querySelector('.resi-btn');
                    if (resiBtn) {
                        resiBtn.dataset.status = status;
                        resiBtn.dataset.resi   = resi;
                        resiBtn.textContent    = resi || 'no_resi';
                    }
                }
                closeModal();
            } else {
                alert('Gagal: ' + (res.message || 'Unknown error'));
            }
        })
        .catch(err => alert('Error: ' + err))
        .finally(() => {
            btn.textContent = 'Simpan';
            btn.disabled    = false;
        });
    });

});

// =====================
// EXPORT CSV (global supaya onclick di blade bisa panggil)
// =====================
function exportCSV() {
    const table = document.getElementById('ordersTable');
    const rows  = [...table.querySelectorAll('tr')].filter(r => r.style.display !== 'none');
    const csv   = rows.map(row =>
        [...row.querySelectorAll('th, td')]
            .map(cell => '"' + cell.textContent.trim().replace(/"/g, '""') + '"')
            .join(',')
    ).join('\n');
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const url  = URL.createObjectURL(blob);
    const a    = document.createElement('a');
    a.href     = url;
    a.download = 'orders_' + new Date().toISOString().slice(0, 10) + '.csv';
    a.click();
    URL.revokeObjectURL(url);
}