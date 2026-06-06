/**
 * JS Khusus Pengaturan Halaman Kelola Home Admin
 */
document.addEventListener("DOMContentLoaded", function() {
    // 1. Ambil elemen pembungkus utama
    const dashboardMain = document.getElementById('dashboard-main');
    
    if (dashboardMain) {
        // 2. Ambil datanya dan langsung potong spasi kosongnya (.trim())
        const successMessage = dashboardMain.getAttribute('data-success') ? dashboardMain.getAttribute('data-success').trim() : '';
        const errorMessage = dashboardMain.getAttribute('data-error') ? dashboardMain.getAttribute('data-error').trim() : '';

        // 3. Eksekusi alert sukses jika ada isinya
        if (successMessage !== "") {
            setTimeout(function() {
                alert("Sukses: " + successMessage);
            }, 100);
        }

        // 4. Eksekusi alert error jika ada isinya
        if (errorMessage !== "") {
            setTimeout(function() {
                alert("Waduh: " + errorMessage);
            }, 100);
        }
    }
});