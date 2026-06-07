const mockProducts = {
    male: {
        atasan: [
            { id: 23, name: "Classic Slim-Fit Black Shirt", img: "/assets/image/imgMixmatch/pria/atscowo1.png", url: "/katalog?id=23" },
            { id: 24, name: "Smart Casual Shirt & Sweater", img: "/assets/image/imgMixmatch/pria/atscowo2.png", url: "/katalog?id=24" },
            { id: 25, name: "Layered Black Open Shirt", img: "/assets/image/imgMixmatch/pria/atscowo3.png", url: "/katalog?id=25" },
            { id: 26, name: "Olive Green Cuban Shirt", img: "/assets/image/imgMixmatch/pria/atscowo4.png", url: "/katalog?id=26" },
            { id: 27, name: "Flannel Plaid Oversized Shirt", img: "/assets/image/imgMixmatch/pria/atscowo5.png", url: "/katalog?id=27" }
        ],
        bawahan: [
            { id: 28, name: "Monogram Tailored Shorts", img: "/assets/image/imgMixmatch/pria/bwhcowo1.png", url: "/katalog?id=28" },
            { id: 29, name: "Army Green Multi-Pocket Cargo", img: "/assets/image/imgMixmatch/pria/bwhcowo2.png", url: "/katalog?id=29" },
            { id: 30, name: "Ripped Black Denim Shorts", img: "/assets/image/imgMixmatch/pria/bwhcowo3.png", url: "/katalog?id=30" },
            { id: 31, name: "Classic 3-Stripes Trackpants", img: "/assets/image/imgMixmatch/pria/bwhcowo4.png", url: "/katalog?id=31" }
        ],
        base: "/assets/image/imgMixmatch/pria/mancard.jpeg", 
        switchIcon: "/assets/image/imgMixmatch/wanita/womancard.jpeg"
    },
    female: {
        atasan: [
            { id: 1, name: "Ribbed Ribbon Crop Top", img: "/assets/image/imgMixmatch/wanita/atscewe1.png", url: "/katalog?id=1" },
            { id: 2, name: "3D Floral Bustier Dress", img: "/assets/image/imgMixmatch/wanita/atscewe2.png", url: "/katalog?id=2" },
            { id: 3, name: "Off-Shoulder Knit Top", img: "/assets/image/imgMixmatch/wanita/atscewe3.png", url: "/katalog?id=3" },
            { id: 4, name: "Ruched Milkmaid Top", img: "/assets/image/imgMixmatch/wanita/atscewe4.png", url: "/katalog?id=4" },
            { id: 5, name: "Asymmetrical Floral Cami", img: "/assets/image/imgMixmatch/wanita/atscewe5.png", url: "/katalog?id=5" },
            { id: 6, name: "Lilac Floral Corset Top", img: "/assets/image/imgMixmatch/wanita/atscewe6.png", url: "/katalog?id=6" },
            { id: 8, name: "Plaid Halter Corset Top", img: "/assets/image/imgMixmatch/wanita/atscewe8.png", url: "/katalog?id=8" },
            { id: 9, name: "Lace Trim Ruffle Blouse", img: "/assets/image/imgMixmatch/wanita/atscewe9.png", url: "/katalog?id=9" },
            { id: 10, name: "Plaid Gingham Camisole", img: "/assets/image/imgMixmatch/wanita/atscewe10.png", url: "/katalog?id=10" },
            { id: 11, name: "Yellow Floral Lace-Up Top", img: "/assets/image/imgMixmatch/wanita/atscewe11.png", url: "/katalog?id=11" },
            { id: 12, name: "Polkadot Ribbon Tie Top", img: "/assets/image/imgMixmatch/wanita/atscewe12.png", url: "/katalog?id=12" },
            { id: 13, name: "Gingham Plaid Bustier", img: "/assets/image/imgMixmatch/wanita/atscewe13.png", url: "/katalog?id=13" }
        ],
        bawahan: [
            { id: 7, name: "Daisy Pattern A-Line Skirt", img: "/assets/image/imgMixmatch/wanita/bwhcewe7.png", url: "/katalog?id=7" },
            { id: 14, name: "Vintage Floral Maxi Skirt", img: "/assets/image/imgMixmatch/wanita/bwhcewe2.png", url: "/katalog?id=14" },
            { id: 15, name: "Floral Mini Skort with Ties", img: "/assets/image/imgMixmatch/wanita/bwhcewe3.png", url: "/katalog?id=15" },
            { id: 16, name: "Denim Pleated Mini Skirt", img: "/assets/image/imgMixmatch/wanita/bwhcewe4.png", url: "/katalog?id=16" },
            { id: 17, name: "Red Gingham Pleated Skirt", img: "/assets/image/imgMixmatch/wanita/bwhcewe5.png", url: "/katalog?id=17" },
            { id: 18, name: "Two-Tone Plaid Mini Skirt", img: "/assets/image/imgMixmatch/wanita/bwhcewe6.png", url: "/katalog?id=18" },
            { id: 19, name: "Y2K Pleated Low-Rise Skirt", img: "/assets/image/imgMixmatch/wanita/bwhcewe7.png", url: "/katalog?id=19" },
            { id: 20, name: "High-Waist Wide Jeans", img: "/assets/image/imgMixmatch/wanita/bwhcewe8.png", url: "/katalog?id=20" },
            { id: 21, name: "Dark Blue Denim Shorts", img: "/assets/image/imgMixmatch/wanita/bwhcewe9.png", url: "/katalog?id=21" },
            { id: 22, name: "Acid Wash Denim Bermuda", img: "/assets/image/imgMixmatch/wanita/bwhcewe10.png", url: "/katalog?id=22" }
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

    // Bersihkan memori autosave saat klik reset manual
    localStorage.removeItem('aktif_mixmatch');

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
    
    // Simpan perubahan gender ke memori
    autoSaveMixMatchProgress();
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
    // TRIGGER UTAMA: Catat progress secara otomatis setiap kali item dipilih!
    autoSaveMixMatchProgress();
}

function showProductPopup(item, category) {
    autoSaveMixMatchProgress();
    if (category === 'atasan') {
        const popupAtasan = document.getElementById('info-box-atasan');
        document.getElementById('p-name-atasan').innerText = item.name;
        
        const linkAtasan = document.getElementById('p-link-atasan');
        const targetUrl = `/katalog?id=${item.id}&from=mixmatch`;
        linkAtasan.href = targetUrl;
        linkAtasan.onclick = function(e) { 
            e.stopPropagation(); 
            window.location.href = targetUrl; 
        };
        
        popupAtasan.style.display = 'block';
    } else {
        const popupBawahan = document.getElementById('info-box-bawahan');
        document.getElementById('p-name-bawahan').innerText = item.name;
        
        const linkBawahan = document.getElementById('p-link-bawahan'); 
        const targetUrl = `/katalog?id=${item.id}&from=mixmatch`;
        
        if (linkBawahan) {
            linkBawahan.href = targetUrl;
            linkBawahan.onclick = function(e) { 
                e.stopPropagation(); 
                window.location.href = targetUrl; 
            };
        }
        
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

function autoSaveMixMatchProgress() {
    const progress = {
        gender: currentGender,
        atasanId: selectedAtasanData ? selectedAtasanData.id : null,
        bawahanId: selectedBawahanData ? selectedBawahanData.id : null
    };
    localStorage.setItem('aktif_mixmatch', JSON.stringify(progress));
}

function allowDrop(e) { e.preventDefault(); }
function clearHighlight() {}
function onDrop(e) { e.preventDefault(); }

// ============================================================================
// SYSTEM UTAMA PEMULIH DATA OTOMATIS (MENCEGAH RESET SAAT KEMBALI DARI KATALOG)
// ============================================================================
document.addEventListener("DOMContentLoaded", function() {
    const savedProgressRaw = localStorage.getItem('aktif_mixmatch');
    
    if (savedProgressRaw) {
        const savedProgress = JSON.parse(savedProgressRaw);
        
        // 1. Pulihkan Gender Terakhir & Buka Workspace-nya langsung
        if (savedProgress.gender) {
            initApp(savedProgress.gender);
        }
        
        // 2. Pulihkan Baju Atasan Terakhir secara Otomatis
        if (savedProgress.atasanId) {
            const listAtasan = mockProducts[savedProgress.gender].atasan;
            const bajuTerakhir = listAtasan.find(item => item.id == savedProgress.atasanId);
            if (bajuTerakhir) {
                // Manfaatkan fungsi selectItem bawaanmu agar gambar otomatis terjahit di maneken
                selectItem(bajuTerakhir, 'atasan');
            }
        }
        
        // 3. Pulihkan Baju Bawahan Terakhir secara Otomatis
        if (savedProgress.bawahanId) {
            const listBawahan = mockProducts[savedProgress.gender].bawahan;
            const celanaTerakhir = listBawahan.find(item => item.id == savedProgress.bawahanId);
            if (celanaTerakhir) {
                // Manfaatkan fungsi selectItem bawaanmu agar gambar otomatis terjahit di maneken
                selectItem(celanaTerakhir, 'bawahan');
            }
        }
    }
});