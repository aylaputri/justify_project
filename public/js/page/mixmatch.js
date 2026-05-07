// File: public/js/mixmatch.js

function startMixMatch(gender, maleImg, femaleImg) {
    console.log("Fungsi startMixMatch jalan untuk gender: " + gender);

    // 1. Cari elemen-elemen yang mau diubah
    const genderRow = document.getElementById('gender-select-row');
    const modelFrame = document.getElementById('active-model-frame');
    const colLeft = document.getElementById('col-left');
    const colRightGroup = document.getElementById('col-right-group');
    const modelImg = document.getElementById('model-img');
    const step2 = document.getElementById('step-2');

    // 2. Hilangkan pilihan gender & Munculkan area Mix & Match
    if (genderRow) genderRow.classList.add('hidden');
    if (modelFrame) modelFrame.classList.remove('hidden');
    if (colLeft) colLeft.classList.remove('hidden');
    if (colRightGroup) colRightGroup.classList.remove('hidden');

    // 3. Pasang gambar model sesuai URL yang dikirim dari HTML
    if (modelImg) {
        modelImg.src = (gender === 'male') ? maleImg : femaleImg;
    }

    // 4. Efek Panduan memanjang ke bawah (Transition)
    if (step2) {
        step2.classList.remove('hidden-content'); // Hapus class sembunyi
        step2.style.maxHeight = "500px";
        step2.style.opacity = "1";
        step2.style.marginTop = "15px";
    }
}

function selectItem(element, name, price) {
    // 1. Ambil semua item di kolom yang sama (biar stroke item lain ilang)
    const allItems = element.parentElement.querySelectorAll('.item-card');
    allItems.forEach(item => item.classList.remove('selected'));

    // 2. Tambahkan stroke hitam ke yang diklik
    element.classList.add('selected');

    // 3. Munculkan Info Card & Update teksnya
    const infoBox = document.getElementById('product-info-box');
    const titleText = document.getElementById('p-title');
    const priceText = document.getElementById('p-price');

    if (infoBox) infoBox.classList.remove('hidden');
    if (titleText) titleText.innerText = name;
    if (priceText) priceText.innerText = price;
}