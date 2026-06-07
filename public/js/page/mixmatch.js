const mockProducts = {
    male: {
        atasan: [
            { id: 23, name: "Casual Black Shirt", img: "/assets/image/imgMixmatch/pria/atscowo1.png", url: "/catalog?id=23" },
            { id: 24, name: "Smart Casual Shirt & Sweater", img: "/assets/image/imgMixmatch/pria/atscowo2.png", url: "/catalog?id=24" },
            { id: 25, name: "Layered Black Open Shirt", img: "/assets/image/imgMixmatch/pria/atscowo3.png", url: "/catalog?id=25" },
            { id: 27, name: "Flannel Plaid Oversized Shirt", img: "/assets/image/imgMixmatch/pria/atscowo4.png", url: "/catalog?id=27" }
        ],
        bawahan: [
            { id: 28, name: "Monogram Tailored Shorts", img: "/assets/image/imgMixmatch/pria/bwhcowo1.png", url: "/catalog?id=28" },
            { id: 29, name: "Army Green Multi-Pocket Cargo", img: "/assets/image/imgMixmatch/pria/bwhcowo2.png", url: "/catalog?id=29" },
            { id: 30, name: "Ripped Black Denim Shorts", img: "/assets/image/imgMixmatch/pria/bwhcowo3.png", url: "/catalog?id=30" },
            { id: 31, name: "Classic 3-Stripes Trackpants", img: "/assets/image/imgMixmatch/pria/bwhcowo4.png", url: "/catalog?id=31" }
        ],
        base: "/assets/image/imgMixmatch/pria/mancard.jpeg", 
        switchIcon: "/assets/image/imgMixmatch/wanita/womancard.jpeg"
    },
    female: {
        atasan: [
            { id: 1, name: "Ribbed Ribbon Crop Top", img: "/assets/image/imgMixmatch/wanita/atscewe1.png", url: "/catalog?id=1" },
            { id: 2, name: "3D Floral Bustier Dress", img: "/assets/image/imgMixmatch/wanita/atscewe2.png", url: "/catalog?id=2" },
            { id: 3, name: "Off-Shoulder Knit Top", img: "/assets/image/imgMixmatch/wanita/atscewe3.png", url: "/catalog?id=3" },
            { id: 4, name: "Ruched Milkmaid Top", img: "/assets/image/imgMixmatch/wanita/atscewe4.png", url: "/catalog?id=4" },
            { id: 5, name: "Kamisol Slim Button", img: "/assets/image/imgMixmatch/wanita/atscewe5.png", url: "/catalog?id=5" }
        ],
        bawahan: [
            { id: 7, name: "Daisy Pattern A-Line Skirt", img: "/assets/image/imgMixmatch/wanita/bwhcewe1.png", url: "/catalog?id=7" },
            { id: 10, name: "Plaid Gingham Camisole", img: "/assets/image/imgMixmatch/wanita/bwhcewe2.png", url: "/catalog?id=10" },
            { id: 14, name: "Vintage Floral Maxi Skirt", img: "/assets/image/imgMixmatch/wanita/bwhcewe3.png", url: "/catalog?id=14" },
            { id: 15, name: "Floral Mini Skort with Ties", img: "/assets/image/imgMixmatch/wanita/bwhcewe4.png", url: "/catalog?id=15" },
            { id: 16, name: "Highwaist Wide Trouser", img: "/assets/image/imgMixmatch/wanita/bwhcewe5.png", url: "/catalog?id=16" }
        ],
        base: "/assets/image/imgMixmatch/wanita/womancard.jpeg",
        switchIcon: "/assets/image/imgMixmatch/pria/mancard.jpeg"
    }
};

let currentGender = 'male';
let selectedAtasanData = null;
let selectedBawahanData = null;

let activeDragElement = null;
let startX = 0;
let startY = 0;
let startLeftOffset = 0; 
let startTop = 0;

let scaleAtasan = 1;
let scaleBawahan = 1;

function initApp(gender) {
    currentGender = gender;
    document.getElementById('gender-step').style.display = 'none';
    document.getElementById('workspace').style.display = 'flex';
    document.getElementById('instruction-text').innerHTML = "✨ <strong>Fitur Advance:</strong> Klik baju untuk pasang. Geser 2D (Bebas) untuk mencocokkan, Scroll/Cubit untuk Zoom!";
    renderWorkspace();
}

// REVISI VALIDASI RESET: Muncul alert proteksi jika canvas kosong saat tombol reset diklik
function resetCombination() {
    if (!selectedAtasanData && !selectedBawahanData) {
        alert("Bung, setidaknya kamu harus memilih satu baju atau bawahan dulu baru bisa direset!");
        return; 
    }

    const yakinReset = window.confirm("Bung, apakah kamu beneran ingin mereset kombinasi pakaian ini?");
    if (!yakinReset) return; 

    selectedAtasanData = null;
    selectedBawahanData = null;
    scaleAtasan = 1;
    scaleBawahan = 1;

    const layerAtasan = document.getElementById('layer-atasan');
    const layerBawahan = document.getElementById('layer-bawahan');

    layerAtasan.style.display = 'none';
    layerAtasan.style.top = '60px';
    layerAtasan.style.left = '50%';
    layerAtasan.style.transform = 'translateX(-50%) scale(1)';

    layerBawahan.style.display = 'none';
    layerBawahan.style.bottom = '25px';
    layerBawahan.style.left = '50%';
    layerBawahan.style.transform = 'translateX(-50%) scale(1)';

    document.getElementById('info-box-atasan').style.display = 'none';
    document.getElementById('info-box-bawahan').style.display = 'none';
}

function switchGender() {
    currentGender = currentGender === 'male' ? 'female' : 'male';
    selectedAtasanData = null;
    selectedBawahanData = null;
    scaleAtasan = 1;
    scaleBawahan = 1;
    document.getElementById('layer-atasan').style.display = 'none';
    document.getElementById('layer-bawahan').style.display = 'none';
    document.getElementById('info-box-atasan').style.display = 'none';
    document.getElementById('info-box-bawahan').style.display = 'none';
    renderWorkspace();
}

function renderWorkspace() {
    const data = mockProducts[currentGender];
    document.getElementById('base-model').src = data.base;
    document.getElementById('switch-icon').src = data.switchIcon;

    const containerAtasan = document.getElementById('list-atasan');
    containerAtasan.innerHTML = '';
    data.atasan.forEach(item => {
        const div = document.createElement('div');
        div.className = 'product-item';
        div.innerHTML = `<img src="${item.img}" alt="${item.name}">`;
        div.onclick = () => selectItem(item, 'atasan');
        containerAtasan.appendChild(div);
    });

    const containerBawahan = document.getElementById('list-bawahan');
    containerBawahan.innerHTML = '';
    data.bawahan.forEach(item => {
        const div = document.createElement('div');
        div.className = 'product-item';
        div.innerHTML = `<img src="${item.img}" alt="${item.name}">`;
        div.onclick = () => selectItem(item, 'bawahan');
        containerBawahan.appendChild(div);
    });
}

function selectItem(item, category) {
    if (category === 'atasan') {
        selectedAtasanData = item;
        scaleAtasan = 1;
        const imgEl = document.getElementById('layer-atasan');
        imgEl.src = item.img;
        imgEl.style.display = 'block';
        imgEl.style.top = '60px';
        imgEl.style.left = '50%';
        imgEl.style.transform = 'translateX(-50%) scale(1)';
        
        makeElementInteractive(imgEl, 'atasan');
        showProductPopup(item, 'atasan');
    } else {
        selectedBawahanData = item;
        scaleBawahan = 1;
        const imgEl = document.getElementById('layer-bawahan');
        imgEl.src = item.img;
        imgEl.style.display = 'block';
        imgEl.style.top = '255px'; 
        imgEl.style.left = '50%';
        imgEl.style.transform = 'translateX(-50%) scale(1)';
        
        makeElementInteractive(imgEl, 'bawahan');
        showProductPopup(item, 'bawahan');
    }
}

// Menampilkan popup detail secara bersamaan tanpa saling menimpa
function showProductPopup(item, category) {
    if (category === 'atasan') {
        const popupAtasan = document.getElementById('info-box-atasan');
        document.getElementById('p-name-atasan').innerText = item.name;
        document.getElementById('p-link-atasan').href = item.url;
        popupAtasan.style.display = 'block';
    } else {
        const popupBawahan = document.getElementById('info-box-bawahan');
        document.getElementById('p-name-bawahan').innerText = item.name;
        document.getElementById('p-link-bawahan').href = item.url;
        popupBawahan.style.display = 'block';
    }
}

function makeElementInteractive(element, type) {
    element.style.cursor = 'move';
    
    element.onwheel = function(e) {
        e.preventDefault();
        let currentScale = (type === 'atasan') ? scaleAtasan : scaleBawahan;
        if (e.deltaY < 0) currentScale += 0.05;
        else currentScale -= 0.05;
        currentScale = Math.min(Math.max(0.5, currentScale), 1.8);
        element.style.transform = `translateX(-50%) scale(${currentScale})`;
        if (type === 'atasan') scaleAtasan = currentScale;
        else scaleBawahan = currentScale;
    };

    element.onmousedown = function(e) {
        e.preventDefault();
        activeDragElement = element;
        startX = e.clientX;
        startY = e.clientY;
        const rect = element.getBoundingClientRect();
        const parentRect = element.parentNode.getBoundingClientRect();
        startLeftOffset = rect.left - parentRect.left + (rect.width / 2); 
        startTop = parseInt(window.getComputedStyle(element).top) || 0;
        document.onmousemove = elementDrag;
        document.onmouseup = stopElementDrag;
    };

    function elementDrag(e) {
        if (!activeDragElement) return;
        let deltaX = e.clientX - startX;
        let deltaY = e.clientY - startY;
        activeDragElement.style.top = (startTop + deltaY) + "px";
        activeDragElement.style.left = `calc(50% + ${deltaX}px)`;
    }

    function stopElementDrag() {
        document.onmousemove = null;
        if (!activeDragElement) return;
        let finalTop = parseInt(activeDragElement.style.top) || 0;
        let leftStyle = activeDragElement.style.left;
        let deltaX = 0;
        if (leftStyle.includes('px')) {
            deltaX = parseInt(leftStyle.replace('calc(50% + ', '').replace('px)', '')) || 0;
        }

        if (Math.abs(deltaX) > 80) {
            alert("⚠️ Posisinya melenceng, Bung! Geser pakaian agar pas di badan maneken.");
            activeDragElement.style.left = '50%';
        }
        
        if (type === 'atasan') {
            if (finalTop > 240 || finalTop < -30) {
                alert("⚠️ Posisinya tidak sesuai, Bung! Atasan dikembalikan.");
                activeDragElement.style.top = '60px';
                activeDragElement.style.left = '50%';
            }
        } else if (type === 'bawahan') {
            if (finalTop < 150 || finalTop > 400) {
                alert("⚠️ Posisinya tidak sesuai, Bung! Bawahan dikembalikan.");
                activeDragElement.style.top = '255px'; 
                activeDragElement.style.left = '50%';
            }
        }
        activeDragElement = null;
    }
}

function saveCombination() {
    if (!selectedAtasanData && !selectedBawahanData) {
        alert("Bung, setidaknya kamu harus memilih satu baju/celana dulu untuk disimpan!");
        return;
    }
    
    const combination = {
        gender: currentGender,
        atasan: selectedAtasanData,
        scaleAtasan: scaleAtasan,
        bawahan: selectedBawahanData,
        scaleBawahan: scaleBawahan,
        savedAt: new Date().toISOString()
    };
    localStorage.setItem('savior_world_wishlist', JSON.stringify(combination));
    alert("🎉 Kombinasi Berhasil Disimpan!");
}

function allowDrop(e) { e.preventDefault(); }
function clearHighlight() {}
function onDrop(e) { e.preventDefault(); }