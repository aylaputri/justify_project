const inputs  = document.querySelectorAll('input');
const saveBtn = document.querySelector('.save-btn');
const cancelBtn = document.querySelector('.cancel-btn');

// Cek semua input terisi → enable tombol Save
function checkInputs() {
    let filled = true;
    inputs.forEach(input => {
        if (input.value.trim() === '') filled = false;
    });
    saveBtn.disabled = !filled;
    saveBtn.style.background = filled ? '#1a1a1a' : '#b1b1b1';
}

inputs.forEach(input => input.addEventListener('input', checkInputs));

// SAVE → kirim ke DB via POST, lalu redirect ke /address
saveBtn.addEventListener('click', () => {
    const data = {
        name:     inputs[0].value.trim(),
        phone:    inputs[1].value.trim(),
        email:    inputs[2].value.trim(),
        title:    inputs[3].value.trim(),
        address:  inputs[4].value.trim(),
        city:     inputs[5].value.trim(),
        province: inputs[6].value.trim(),
        postal:   inputs[7].value.trim(),
    };

    fetch('/addAddress', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
        },
        body: JSON.stringify(data),
    })
    .then(r => r.json())
    .then(() => {
        // Setelah simpan ke DB, balik ke halaman pilih address
        window.location.href = '/address';
    })
    .catch(() => alert('Gagal menyimpan alamat, coba lagi.'));
});

// CANCEL → balik ke address
cancelBtn.addEventListener('click', () => {
    window.location.href = '/address';
});