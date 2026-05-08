// Database Produk - Sesuaikan nama file dengan folder assets/image/imgMixmatch/pria atau wanita
const databaseProduk = [
    //koleksi pria
    { gender: 'male', type: 'atasan', name: 'Atasan Cowok 1', img: 'atscowo1.png' },
    { gender: 'male', type: 'atasan', name: 'Atasan Cowok 2', img: 'atscowo2.png' },
    { gender: 'male', type: 'atasan', name: 'Atasan Cowok 3', img: 'atscowo3.png' },
    { gender: 'male', type: 'atasan', name: 'Atasan Cowok 4', img: 'atscowo4.png' },
    { gender: 'male', type: 'bawahan', name: 'Bawahan Cowok 1', img: 'bwhcowo1.png' },
    { gender: 'male', type: 'bawahan', name: 'Bawahan Cowok 2', img: 'bwhcowo2.png' },
    { gender: 'male', type: 'bawahan', name: 'Bawahan Cowok 3', img: 'bwhcowo3.png' },
    { gender: 'male', type: 'bawahan', name: 'Bawahan Cowok 4', img: 'bwhcowo4.png' },

    //koleksi wanitq
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 1', img: 'atscewe1.png' }, 
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 2', img: 'atscewe2.png' },
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 3', img: 'atscewe3.png' },
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 4', img: 'atscewe4.png' },
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 5', img: 'atscewe5.png' },
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 6', img: 'atscewe6.png' }, 
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 7', img: 'atscewe7.png' },
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 8', img: 'atscewe8.png' },
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 9', img: 'atscewe9.png' },
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 10', img: 'atscewe10.png' },
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 11', img: 'atscewe11.png' }, 
    { gender: 'female', type: 'atasan', name: 'Atasan Cewek 12', img: 'atscewe12.png' },
    
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 1', img: 'bwhcewe1.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 2', img: 'bwhcewe2.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 3', img: 'bwhcewe3.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 4', img: 'bwhcewe4.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 5', img: 'bwhcewe5.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 6', img: 'bwhcewe6.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 7', img: 'bwhcewe7.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 8', img: 'bwhcewe8.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 9', img: 'bwhcewe9.png' },
    { gender: 'female', type: 'bawahan', name: 'Bawahan Cewek 10', img: 'bwhcewe10.png' },
];

let currentGender = '';

// Fungsi Inisialisasi Aplikasi (Heuristic #1)
function initApp(gender) {
    currentGender = gender;
    document.getElementById('gender-step').style.display = 'none';
    document.getElementById('workspace').style.display = 'flex';
    renderWorkspace();
}

// Render Ulang Seluruh Workspace saat tukar gender (Dynamic Filter)
function renderWorkspace() {
    const folder = (currentGender === 'male') ? 'pria' : 'wanita';
    const altFolder = (currentGender === 'male') ? 'wanita' : 'pria';

    // 1. Ganti Manekin Dasar (Path sesuai screenshot asset kamu)
    document.getElementById('base-model').src = `/assets/image/imgMixmatch/${folder}/mancard.jpeg`;

    // 2. Ganti Ikon Switch ke Karakter Lawan Jenis (Revisi diskusi terakhir)
    document.getElementById('switch-icon').src = `/assets/image/imgMixmatch/${altFolder}/mancard.jpeg`;

    // 3. Reset Layer Baju & Detail
    document.getElementById('layer-atasan').style.display = 'none';
    document.getElementById('layer-bawahan').style.display = 'none';
    document.getElementById('info-box').style.display = 'none';
    document.getElementById('instruction-text').innerText = "Tarik pakaian ke tubuh manekin untuk mulai mix & match.";

    // 4. Render Koleksi Samping berdasarkan Gender yang Aktif
    const tops = databaseProduk.filter(p => p.gender === currentGender && p.type === 'atasan');
    const bottoms = databaseProduk.filter(p => p.gender === currentGender && p.type === 'bawahan');

    renderItems(tops, 'list-atasan', folder);
    renderItems(bottoms, 'list-bawahan', folder);
}

// Fungsi Render List Produk (Heuristic #6)
function renderItems(items, containerId, folder) {
    const container = document.getElementById(containerId);
    container.innerHTML = "";
    items.forEach(item => {
        const div = document.createElement('div');
        div.className = 'product-item';
        div.draggable = true;
        const imgPath = `/assets/image/imgMixmatch/${folder}/${item.img}`;
        div.innerHTML = `<img src="${imgPath}" alt="${item.name}">`;
        
        // Event Drag Start
        div.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData("imgSrc", imgPath);
            e.dataTransfer.setData("type", item.type);
            e.dataTransfer.setData("name", item.name);
        });
        container.appendChild(div);
    });
}

// Fungsi Tukar Gender Cepat (Heuristic #7)
function switchGender() {
    currentGender = (currentGender === 'male') ? 'female' : 'male';
    renderWorkspace();
}

// Logika Drag & Drop
function allowDrop(e) {
    e.preventDefault();
    document.getElementById('drop-zone').classList.add('active-drag');
}

function clearHighlight() {
    document.getElementById('drop-zone').classList.remove('active-drag');
}

function onDrop(e) {
    e.preventDefault();
    clearHighlight();
    const imgSrc = e.dataTransfer.getData("imgSrc");
    const type = e.dataTransfer.getData("type");
    const name = e.dataTransfer.getData("name");

    if (type === 'atasan') {
        const layer = document.getElementById('layer-atasan');
        layer.src = imgSrc;
        layer.style.display = 'block';
    } else if (type === 'bawahan') {
        const layer = document.getElementById('layer-bawahan');
        layer.src = imgSrc;
        layer.style.display = 'block';
    }

    // Update Box Detail
    document.getElementById('p-name').innerText = name;
    document.getElementById('info-box').style.display = 'block';
}

function saveCombination() {
    alert("Kombinasi Berhasil Disimpan ke Koleksi!");
}