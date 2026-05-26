const dropdownButton =
    document.querySelector('.dropdown-button');

const dropdownContent =
    document.querySelector('.dropdown-content');

const dropdownArrow =
    document.querySelector('.dropdown-arrow');

/* =========================
   DROPDOWN
========================= */

dropdownButton.addEventListener('click', function () {

    dropdownContent.classList.toggle('show');

    dropdownArrow.classList.toggle('rotate');

});

/* =========================
   LOGOUT
========================= */

function confirmLogout() {

    const logout = confirm(
        'Yakin ingin logout?'
    );

    if (logout) {

        window.location.href =
            '/admin/logout';

    }

}