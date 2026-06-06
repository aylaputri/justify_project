const fullNameInput = document.getElementById('full_name');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const submitButton = document.getElementById('submitButton');

const togglePassword = document.getElementById('togglePassword');
const passwordField = document.getElementById('password');
const eyeIcon = document.getElementById('eyeIcon');

/* AKTIF BUTTON LOGIN */

function checkInput() {

    const isRegisterPage = fullNameInput !== null;

    if (isRegisterPage) {
        if (
            fullNameInput.value.trim() !== '' &&
            emailInput.value.trim() !== '' &&
            passwordInput.value.trim() !== ''
        ) {
            submitButton.disabled = false;
            submitButton.classList.add('active');
        } else {
            submitButton.disabled = true;
            submitButton.classList.remove('active');
        }
    } else {
        if (
            emailInput.value.trim() !== '' &&
            passwordInput.value.trim() !== ''
        ) {
            submitButton.disabled = false;
            submitButton.classList.add('active');
        } else {
            submitButton.disabled = true;
            submitButton.classList.remove('active');
        }
    }
}

/* INPUT LISTENER */
if (fullNameInput) {
    fullNameInput.addEventListener('input', checkInput);
}
if (emailInput) {
    emailInput.addEventListener('input', checkInput);
}
passwordInput.addEventListener('input', checkInput);

/* SHOW HIDE PASSWORD */

togglePassword.addEventListener('click', function () {

    if (passwordField.type === 'password') {

        passwordField.type = 'text';

        // GANTI ICON MATA TERBUKA
        eyeIcon.src = '../assets/icon/mata-kebuka-hitam.svg';

    } else {

        passwordField.type = 'password';

        // GANTI ICON MATA TERTUTUP
        eyeIcon.src = '../assets/icon/mata-ketutup-hitam.svg';

    }

});

checkInput();