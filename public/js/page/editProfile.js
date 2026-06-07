document.addEventListener('DOMContentLoaded', function () {
    const photoFrame = document.getElementById('photoFrame');
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const photoPlaceholder = document.getElementById('photoPlaceholder');
    const btnSubmitProfile = document.getElementById('btnSubmitProfile');
    const profileForm = document.getElementById('profileForm');

    // 1. Trigger input file saat bingkai foto di-tap
    if (photoFrame && photoInput) {
        photoFrame.addEventListener('click', function () {
            photoInput.click();
        });
    }

    // 2. Operasi Preview Gambar secara Realtime sebelum Upload
    if (photoInput) {
        photoInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (ev) {
                if (photoPreview) {
                    photoPreview.src = ev.target.result;
                    photoPreview.style.display = 'block';
                }
                if (photoPlaceholder) {
                    photoPlaceholder.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        });
    }

    // 3. Global Event Delegation untuk Toggle Show/Hide Password
    document.body.addEventListener('click', function (event) {
        const toggleButton = event.target.closest('.toggle-pw');
        if (!toggleButton) return;

        const targetId = toggleButton.getAttribute('data-target');
        const passwordInput = document.getElementById(targetId);

        if (passwordInput) {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.style.color = '#1a1a1a'; // Highlight aktif saat plain text
            } else {
                passwordInput.type = 'password';
                toggleButton.style.color = '#888'; // Kembalikan ke warna redup
            }
        }
    });

    // 4. Submit Form Handler melalui Tombol Simpan Terpisah
    if (btnSubmitProfile && profileForm) {
        btnSubmitProfile.addEventListener('click', function () {
            // Memvalidasi HTML5 Required Attributes (Nama Lengkap & Email) sebelum mengirim data
            if (profileForm.checkValidity()) {
                btnSubmitProfile.disabled = true;
                btnSubmitProfile.textContent = 'Menyimpan...';
                profileForm.submit();
            } else {
                profileForm.reportValidity();
            }
        });
    }
});