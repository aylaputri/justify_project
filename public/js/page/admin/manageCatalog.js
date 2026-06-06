document.addEventListener('DOMContentLoaded', function () {
    /* ─────────────────────────────────────────
       ELEMEN UTAMA
    ───────────────────────────────────────── */
    const modalOverlay          = document.getElementById('productModalOverlay');
    const modalTitle            = document.getElementById('modalTitle');
    const productForm           = document.getElementById('productForm');
    const imagePreview          = document.getElementById('imagePreview');
    const productIdInput        = document.getElementById('product_id');
    const productNameInput      = document.getElementById('product_name');
    const productCategoryInput  = document.getElementById('product_category');
    const productDescInput      = document.getElementById('product_description');
    const productImageInput     = document.getElementById('product_image');
    const productPriceInput     = document.getElementById('product_price');
    const productStockInput     = document.getElementById('product_stock');
    const productStatusInput    = document.getElementById('product_status');
    const sizeSection           = document.getElementById('sizeSection');
    const sizeCheckboxGroup     = document.getElementById('sizeCheckboxGroup');
    const sizeChartSection      = document.getElementById('sizeChartSection');
    const sizeChartTable        = document.getElementById('sizeChartTable');

    /* ─────────────────────────────────────────
       TAG INPUT — Warna
    ───────────────────────────────────────── */
    const colorTagsDisplay  = document.getElementById('colorTags');
    const colorInput        = document.getElementById('colorInput');
    const colorsHidden      = document.getElementById('colorsHidden');
    let colorTags = [];

    function renderColorTags() {
        colorTagsDisplay.innerHTML = '';
        colorTags.forEach((tag, i) => {
            const span = document.createElement('span');
            span.className = 'tag-item';
            span.innerHTML = `${tag} <span class="tag-remove" data-index="${i}">×</span>`;
            colorTagsDisplay.appendChild(span);
        });
        colorsHidden.value = JSON.stringify(colorTags);
    }

    colorInput.addEventListener('keydown', function (e) {
        if ((e.key === 'Enter' || e.key === ',') && this.value.trim()) {
            e.preventDefault();
            const val = this.value.trim().replace(/,$/, '');
            if (val && !colorTags.includes(val)) {
                colorTags.push(val);
                renderColorTags();
            }
            this.value = '';
        } else if (e.key === 'Backspace' && !this.value && colorTags.length) {
            colorTags.pop();
            renderColorTags();
        }
    });

    colorTagsDisplay.addEventListener('click', function (e) {
        if (e.target.classList.contains('tag-remove')) {
            colorTags.splice(parseInt(e.target.dataset.index), 1);
            renderColorTags();
        }
    });

    document.getElementById('colorTagWrapper').addEventListener('click', () => colorInput.focus());

    function clearColorTags() {
        colorTags = [];
        renderColorTags();
        colorInput.value = '';
    }

    function setColorTags(arr) {
        colorTags = [...arr];
        renderColorTags();
    }

    /* ─────────────────────────────────────────
       LOAD SIZE CHART + CHECKBOX UKURAN
    ───────────────────────────────────────── */
    async function loadSizeData(categoryId, checkedSizes = []) {
        if (!categoryId) {
            sizeSection.style.display      = 'none';
            sizeChartSection.style.display = 'none';
            sizeCheckboxGroup.innerHTML    = '';
            sizeChartTable.innerHTML       = '';
            return;
        }
        try {
            const res  = await fetch(`${SIZECHART_URL}/${categoryId}`);
            const data = await res.json();

            if (!data || data.length === 0) {
                sizeSection.style.display      = 'none';
                sizeChartSection.style.display = 'none';
                return;
            }

            sizeCheckboxGroup.innerHTML = '';
            data.forEach(row => {
                const isChecked = checkedSizes.includes(row.size) ? 'checked' : '';
                sizeCheckboxGroup.innerHTML += `
                    <label>
                        <input type="checkbox" name="sizes[]"
                            value="${row.size}" ${isChecked}>
                        <span>${row.size}</span>
                    </label>`;
            });
            sizeSection.style.display = 'block';

            const rows = data.map(r => `
                <tr>
                    <td>${r.size}</td>
                    <td>${r.length_cm}</td>
                    <td>${r.width_cm}</td>
                </tr>`).join('');

            sizeChartTable.innerHTML = `
                <div class="chart-header">Jenis ukuran: Tinggi &amp; besar, Reguler</div>
                <div class="chart-subheader">Ukuran tubuh</div>
                <table>
                    <thead>
                        <tr>
                            <th>Ukuran</th>
                            <th>Tinggi (cm)</th>
                            <th>Lebar bahu (cm)</th>
                        </tr>
                    </thead>
                    <tbody>${rows}</tbody>
                </table>`;
            sizeChartSection.style.display = 'block';

        } catch (err) {
            console.error('Gagal load size chart:', err);
            sizeSection.style.display      = 'none';
            sizeChartSection.style.display = 'none';
        }
    }

    productCategoryInput.addEventListener('change', function () {
        loadSizeData(this.value);
    });

    /* ─────────────────────────────────────────
       BUKA MODAL — Tambah Produk
    ───────────────────────────────────────── */
    document.getElementById('addProductBtn').addEventListener('click', function () {
        modalTitle.textContent = 'Tambah Produk';
        productForm.reset();
        productIdInput.value        = '';
        imagePreview.innerHTML      = '';
        productPriceInput.value     = '';
        productStockInput.value     = '';
        productStatusInput.value    = 'Ready';
        clearColorTags();
        sizeSection.style.display      = 'none';
        sizeChartSection.style.display = 'none';
        sizeCheckboxGroup.innerHTML    = '';
        sizeChartTable.innerHTML       = '';
        productForm.action = '/admin/catalog/store';
        document.getElementById('methodField').value = 'POST';
        modalOverlay.classList.add('active');
    });

    /* ─────────────────────────────────────────
       BUKA MODAL — Edit Produk (auto-fill)
    ───────────────────────────────────────── */
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', async function () {
            modalTitle.textContent = 'Edit Produk';
            productForm.reset();

            const id          = this.dataset.id;
            const name        = this.dataset.name;
            const category    = this.dataset.category;
            const description = this.dataset.description;
            const imageUrl    = this.dataset.image;
            const sizes       = JSON.parse(this.dataset.sizes  || '[]');
            const colors      = JSON.parse(this.dataset.colors || '[]');
            const price       = this.dataset.price  || '';
            const stock       = this.dataset.stock  || '';
            const status      = this.dataset.status || 'Ready';

            productIdInput.value          = id;
            productNameInput.value        = name;
            productCategoryInput.value    = category;
            productDescInput.value        = description;
            productPriceInput.value       = price;
            productStockInput.value       = stock;
            productStatusInput.value      = status;

            await loadSizeData(category, sizes);
            setColorTags(colors);

            imagePreview.innerHTML = imageUrl
                ? `<img src="${imageUrl}" alt="Preview">`
                : '';

            productForm.action = `/admin/catalog/update/${id}`;
            document.getElementById('methodField').value = 'PUT';
            modalOverlay.classList.add('active');
        });
    });

    /* ─────────────────────────────────────────
       TUTUP MODAL
    ───────────────────────────────────────── */
    function closeModal() {
        modalOverlay.classList.remove('active');
    }
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('btnCancelModal').addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', e => { if (e.target === modalOverlay) closeModal(); });

    /* ─────────────────────────────────────────
       LIVE PREVIEW GAMBAR
    ───────────────────────────────────────── */
    productImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(file);
    });

    /* ─────────────────────────────────────────
       DELETE MODAL
    ───────────────────────────────────────── */
    const deleteOverlay = document.getElementById('deleteOverlay');
    let deleteId = null;

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            deleteId = this.dataset.id;
            deleteOverlay.classList.add('active');
        });
    });

    document.getElementById('cancelDelete').addEventListener('click', () => {
        deleteOverlay.classList.remove('active');
        deleteId = null;
    });

    document.getElementById('confirmDelete').addEventListener('click', () => {
        if (deleteId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/catalog/delete/${deleteId}`;

            const csrf = document.createElement('input');
            csrf.type  = 'hidden';
            csrf.name  = '_token';
            csrf.value = CSRF_TOKEN;

            const method = document.createElement('input');
            method.type  = 'hidden';
            method.name  = '_method';
            method.value = 'DELETE';

            form.appendChild(csrf);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    });

    deleteOverlay.addEventListener('click', e => {
        if (e.target === deleteOverlay) {
            deleteOverlay.classList.remove('active');
            deleteId = null;
        }
    });
});