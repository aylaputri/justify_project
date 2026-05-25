const inputs = document.querySelectorAll('input');
const saveBtn = document.querySelector('.save-btn');

function checkInputs() {

    let filled = true;

    inputs.forEach(input => {

        if(input.value.trim() === ''){
            filled = false;
        }

    });

    saveBtn.disabled = !filled;

    if(filled){
        saveBtn.style.background = 'black';
    } else {
        saveBtn.style.background = '#b1b1b1';
    }
}

inputs.forEach(input => {
    input.addEventListener('input', checkInputs);
});