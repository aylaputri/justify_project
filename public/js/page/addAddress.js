const inputs = document.querySelectorAll('input');

const saveBtn = document.querySelector('.save-btn');

const cancelBtn = document.querySelector('.cancel-btn');

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


// SAVE ADDRESS
saveBtn.addEventListener("click", () => {

    const addressData = {

        name: inputs[0].value,

        phone: inputs[1].value,

        email: inputs[2].value,

        title: inputs[3].value,

        address: inputs[4].value,

        city: inputs[5].value,

        province: inputs[6].value,

        postal: inputs[7].value,
    };

    localStorage.setItem(
        "address",
        JSON.stringify(addressData)
    );

    alert("Alamat berhasil disimpan!");

    window.location.href = "/checkout";
});


// CANCEL
cancelBtn.addEventListener("click", () => {

    window.location.href = "/checkout";
});