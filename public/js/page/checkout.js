document.getElementById('pay-button')
.addEventListener('click', function () {

    fetch('/checkout/payment', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        }

    })

    .then(response => response.json())

    .then(data => {

        snap.pay(data.snap_token);

    });

});