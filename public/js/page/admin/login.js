const usernameInput = document.getElementById('username');
const passwordInput = document.getElementById('password');
const loginButton = document.getElementById('loginButton');

const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('password');
const eyeIcon = document.getElementById('eyeIcon');

/* AKTIF BUTTON LOGIN */

function checkInput() {

    if (
        usernameInput.value.trim() !== '' &&
        passwordInput.value.trim() !== ''
    ) {

        loginButton.disabled = false;
        loginButton.classList.add('active');

    } else {

        loginButton.disabled = true;
        loginButton.classList.remove('active');

    }

}

usernameInput.addEventListener('input', checkInput);
passwordInput.addEventListener('input', checkInput);

/* SHOW HIDE PASSWORD */

togglePassword.addEventListener('click', function () {

    if (passwordField.type === 'password') {

        passwordField.type = 'text';

        // GANTI ICON MATA TERBUKA
        eyeIcon.src = '../../assets/icon/mata-kebuka-hitam.svg';

    } else {

        passwordField.type = 'password';

        // GANTI ICON MATA TERTUTUP
        eyeIcon.src = '../../assets/icon/mata-ketutup-hitam.svg';

    }

});