document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('.faq-question');
    console.log('FAQ questions found:', items.length); // harus > 0

    items.forEach(function (el) {
        el.addEventListener('click', function () {
            console.log('clicked!'); // cek apakah event terpanggil
            const item   = el.closest('.faq-item');
            const answer = item.querySelector('.faq-answer');
            const isOpen = item.classList.contains('open');

            item.closest('.faq-card').querySelectorAll('.faq-item.open').forEach(function (i) {
                i.classList.remove('open');
                i.querySelector('.faq-answer').style.maxHeight = '0';
            });

            if (!isOpen) {
                item.classList.add('open');
                answer.style.maxHeight = answer.scrollHeight + 'px';
            }
        });
    });
});