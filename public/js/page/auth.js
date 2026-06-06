const fullNameInput = document.getElementById('fullName');
const emailInput = document.getElementById('email');

const passwordInput =
    document.getElementById('password');

const confirmPasswordInput =
    document.getElementById(
        'passwordConfirmation'
    );

const submitButton =
    document.getElementById(
        'submitButton'
    );

const togglePassword =
    document.getElementById(
        'togglePassword'
    );

const passwordField =
    document.getElementById(
        'password'
    );

const eyeIcon =
    document.getElementById(
        'eyeIcon'
    );

/* =========================
   BUTTON ACTIVE
========================= */

function checkInput() {

    if (!submitButton) return;

    // REGISTER
    if (
        fullNameInput &&
        emailInput &&
        passwordInput
    ) {

        const valid =
            fullNameInput.value.trim() !== '' &&
            emailInput.value.trim() !== '' &&
            passwordInput.value.trim() !== '';

        submitButton.disabled = !valid;
        submitButton.classList.toggle(
            'active',
            valid
        );

        return;
    }

    // LOGIN
    if (
        !fullNameInput &&
        emailInput &&
        passwordInput
    ) {

        const valid =
            emailInput.value.trim() !== '' &&
            passwordInput.value.trim() !== '';

        submitButton.disabled = !valid;
        submitButton.classList.toggle(
            'active',
            valid
        );

        return;
    }

    // FORGOT PASSWORD
    if (
        emailInput &&
        !passwordInput
    ) {

        const valid =
            emailInput.value.trim() !== '';

        submitButton.disabled = !valid;
        submitButton.classList.toggle(
            'active',
            valid
        );

        return;
    }

    // RESET PASSWORD
    if (
        passwordInput &&
        confirmPasswordInput &&
        !emailInput
    ) {

        const valid =
            passwordInput.value.trim() !== '' &&
            confirmPasswordInput.value.trim() !== '';

        submitButton.disabled = !valid;
        submitButton.classList.toggle(
            'active',
            valid
        );

        return;
    }
}

/* =========================
   INPUT LISTENER
========================= */

fullNameInput?.addEventListener(
    'input',
    checkInput
);

emailInput?.addEventListener(
    'input',
    checkInput
);

passwordInput?.addEventListener(
    'input',
    checkInput
);

confirmPasswordInput?.addEventListener(
    'input',
    checkInput
);

/* =========================
   SHOW / HIDE PASSWORD
========================= */

if (
    togglePassword &&
    passwordField &&
    eyeIcon
) {

    togglePassword.addEventListener(
        'click',
        function () {

            if (
                passwordField.type ===
                'password'
            ) {

                passwordField.type =
                    'text';

                eyeIcon.src =
                    '/assets/icon/mata-kebuka-hitam.svg';

            } else {

                passwordField.type =
                    'password';

                eyeIcon.src =
                    '/assets/icon/mata-ketutup-hitam.svg';

            }

        }
    );

}

/* =========================
   INIT
========================= */

checkInput();