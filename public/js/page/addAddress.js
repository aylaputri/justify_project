const cfg     = window.AddAddressConfig;
const form    = document.getElementById('addAddressForm');
const saveBtn = document.getElementById('saveBtn');

// Enable save button kalau semua required field terisi
const requiredInputs = form.querySelectorAll('input[required]');
function checkForm() {
    const allFilled = [...requiredInputs].every(i => i.value.trim() !== '');
    saveBtn.disabled = !allFilled;
}
requiredInputs.forEach(i => i.addEventListener('input', checkForm));

// Submit
saveBtn.addEventListener('click', async () => {
    saveBtn.disabled = true;
    saveBtn.textContent = 'Menyimpan...';

    const body = {
        recipient_name:   form.querySelector('[name="recipient_name"]').value.trim(),
        phone:            form.querySelector('[name="phone"]').value.trim(),
        email:            form.querySelector('[name="email"]').value.trim(),
        address_title:    form.querySelector('[name="address_title"]').value.trim(),
        complete_address: form.querySelector('[name="complete_address"]').value.trim(),
        city:             form.querySelector('[name="city"]').value.trim(),
        province:         form.querySelector('[name="province"]').value.trim(),
        postal_code:      form.querySelector('[name="postal_code"]').value.trim(),
    };

    try {
        const res  = await fetch(cfg.storeUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': cfg.csrfToken,
            },
            body: JSON.stringify(body),
        });
        const data = await res.json();

        if (data.success) {
            // Kalau dari checkout, langsung set alamat ini lalu balik ke checkout
            if (cfg.fromCheckout && data.id_address) {
                await fetch('/checkout/select-address', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': cfg.csrfToken,
                    },
                    body: JSON.stringify({ id_address: data.id_address }),
                });
                window.location.href = '/checkout';
            } else {
                window.location.href = '/address';
            }
        } else {
            alert(data.message || 'Gagal menyimpan alamat.');
            saveBtn.disabled = false;
            saveBtn.textContent = 'Save';
        }
    } catch (err) {
        console.error(err);
        alert('Terjadi kesalahan. Coba lagi.');
        saveBtn.disabled = false;
        saveBtn.textContent = 'Save';
    }
});