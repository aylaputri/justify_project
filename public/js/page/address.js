document.addEventListener('DOMContentLoaded', function () {
    const config       = window.AddressConfig || {};
    const csrfToken    = config.csrfToken || '';
    const fromCheckout = config.fromCheckout || false;

    const editModal        = document.getElementById('editModal');
    const deleteConfirm    = document.getElementById('deleteConfirm');
    const btnCancelEdit    = document.getElementById('btnCancelEdit');
    const btnSaveEdit      = document.getElementById('btnSaveEdit');
    const btnCancelDelete  = document.getElementById('btnCancelDelete');
    const btnConfirmDelete = document.getElementById('btnConfirmDelete');
    const btnApplyAddress  = document.getElementById('btnApplyAddress');
    const addressList      = document.getElementById('addressList');
    let pendingDeleteId    = null;
    let selectedCardId     = null;

    // ─── SELECT ──────────────────────────────────────────
    addressList.addEventListener('click', function (e) {
        if (e.target.closest('.btn-edit') || e.target.closest('.btn-delete')) return;
        const card = e.target.closest('.address-card');
        if (!card) return;
        document.querySelectorAll('.address-card').forEach(c => c.classList.remove('selected'));
        card.classList.add('selected');
        selectedCardId = card.dataset.id;
    });

    // ─── EDIT ────────────────────────────────────────────
    addressList.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-edit');
        if (!btn) return;
        const id   = btn.dataset.id;
        const card = document.getElementById('card-' + id);
        document.getElementById('editId').value       = id;
        document.getElementById('editTitle').value    = card.dataset.title;
        document.getElementById('editAddress').value  = card.dataset.address;
        document.getElementById('editCity').value     = card.dataset.city;
        document.getElementById('editProvince').value = card.dataset.province;
        document.getElementById('editPostal').value   = card.dataset.postal;
        editModal.classList.add('show');
    });

    btnCancelEdit.addEventListener('click', () => editModal.classList.remove('show'));
    editModal.addEventListener('click', e => { if (e.target === editModal) editModal.classList.remove('show'); });

    btnSaveEdit.addEventListener('click', async function () {
        const id   = document.getElementById('editId').value;
        const body = {
            title:    document.getElementById('editTitle').value.trim(),
            address:  document.getElementById('editAddress').value.trim(),
            city:     document.getElementById('editCity').value.trim(),
            province: document.getElementById('editProvince').value.trim(),
            postal:   document.getElementById('editPostal').value.trim(),
        };
        if (!body.title || !body.address || !body.city || !body.province || !body.postal) {
            alert('Semua field harus diisi.'); return;
        }
        try {
            const res  = await fetch(`/address/${id}/update`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify(body),
            });
            const data = await res.json();
            if (data.success) {
                const card = document.getElementById('card-' + id);
                card.dataset.title    = body.title;
                card.dataset.address  = body.address;
                card.dataset.city     = body.city;
                card.dataset.province = body.province;
                card.dataset.postal   = body.postal;
                card.querySelector('.addr-title').textContent  = body.title;
                card.querySelector('.addr-detail').textContent = `${body.address}, ${body.city}, ${body.province}.`;
                editModal.classList.remove('show');
            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan.'));
            }
        } catch (err) {
            alert('Gagal menyimpan: ' + err);
        }
    });

    // ─── DELETE ──────────────────────────────────────────
    addressList.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-delete');
        if (!btn) return;
        pendingDeleteId = btn.dataset.id;
        deleteConfirm.classList.add('show');
    });

    btnCancelDelete.addEventListener('click', () => {
        pendingDeleteId = null;
        deleteConfirm.classList.remove('show');
    });
    deleteConfirm.addEventListener('click', e => {
        if (e.target === deleteConfirm) { pendingDeleteId = null; deleteConfirm.classList.remove('show'); }
    });

    btnConfirmDelete.addEventListener('click', async function () {
        if (!pendingDeleteId) return;
        try {
            const res  = await fetch(`/address/${pendingDeleteId}/delete`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({}),
            });
            const data = await res.json();
            if (data.success) {
                document.getElementById('card-' + pendingDeleteId)?.remove();
                if (document.querySelectorAll('.address-card').length === 0) {
                    const p = document.createElement('p');
                    p.id = 'emptyText'; p.className = 'empty-text';
                    p.textContent = 'Belum ada alamat tersimpan';
                    addressList.appendChild(p);
                }
                deleteConfirm.classList.remove('show');
                pendingDeleteId = null;
            } else {
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan.'));
            }
        } catch (err) {
            alert('Gagal menghapus: ' + err);
        }
    });

    // ─── APPLY — simpan ke session PHP via POST ───────────
    if (btnApplyAddress && fromCheckout) {
        btnApplyAddress.addEventListener('click', function () {
            if (!selectedCardId) {
                alert('Pilih alamat terlebih dahulu.'); return;
            }
            fetch('/checkout/select-address', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ id_address: selectedCardId }),
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) window.location.href = '/checkout';
                else alert('Gagal memilih alamat: ' + (d.message || ''));
            })
            .catch(() => alert('Terjadi kesalahan jaringan'));
        });
    }
});