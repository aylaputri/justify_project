@extends('layouts.admin')

@section('title', 'Manage Catalog')

@push('style')
<link rel="stylesheet" href="{{ asset('css/page/admin/manageCatalog.css') }}">
@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">
            @if($errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif
            <h1 class="page-title">Catalog</h1>
            <p class="page-subtitle">Manage Catalog Savior World</p>

            <div class="catalog-top">
                <h3>Semua Produk ({{ $products->count() }})</h3>
                <button type="button" id="addProductBtn" class="btn-add">
                    <img src="{{ asset('assets/icon/tambah-produk.svg') }}" alt="Tambah">
                    Tambah Produk Baru
                </button>
            </div>

            <div class="catalog-wrapper">
                <table class="catalog-table">
                    <thead>
                        <tr>
                            <th>Products</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            @php
                                $variant        = $product->variants->first();
                                $image          = $variant?->images->first();
                                $selectedSizes  = $product->variants->pluck('size')->unique()->values()->toArray();
                                $selectedColors = $product->variants->pluck('color')->unique()->values()->toArray();
                            @endphp
                            <tr>
                                <td>
                                    <div class="catalog-product">
                                        @if($image)
                                            <img src="{{ asset($image->image_url) }}" class="product-img">
                                        @else
                                            <div class="no-image">No Image</div>
                                        @endif
                                        <div>
                                            <h4>{{ $product->product_name }}</h4>
                                            <span>ID {{ $product->id_product }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->category?->category_name ?? '-' }}</td>
                                <td>Rp {{ number_format($variant?->price ?? 0) }}</td>
                                <td>{{ $variant?->stock ?? 0 }}</td>
                                <td>
                                    <span class="status-badge">{{ $variant?->status ?? '-' }}</span>
                                </td>
                                <td>
                                    <button
                                        class="edit-btn"
                                        data-id="{{ $product->id_product }}"
                                        data-name="{{ $product->product_name }}"
                                        data-category="{{ $product->id_category }}"
                                        data-sizes='@json($selectedSizes)'
                                        data-colors='@json($selectedColors)'
                                        data-description="{{ $product->description }}"
                                        data-price="{{ $variant?->price ?? 0 }}"
                                        data-stock="{{ $variant?->stock ?? 0 }}"
                                        data-status="{{ $variant?->status ?? 'Ready' }}"
                                        data-image="{{ $image ? asset($image->image_url) : '' }}">
                                        <img src="{{ asset('assets/icon/edit-produk.svg') }}" alt="Edit">
                                    </button>
                                    <button class="delete-btn" data-id="{{ $product->id_product }}">
                                        <img src="{{ asset('assets/icon/hapus-produk.svg') }}" alt="Delete">
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty-data">Belum ada produk</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </section>
    </section>
</main>

{{-- ===== MODAL TAMBAH / EDIT ===== --}}
<div class="overlay-details" id="productModalOverlay">
    <div class="modal catalog-modal">
        <div class="modal-header">
            <h2 id="modalTitle">Tambah Produk</h2>
            <span class="close" id="closeModal">✕</span>
        </div>
        <div class="modal-content">
            <form id="productForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="methodField" name="_method" value="POST">
                <input type="hidden" id="product_id" name="product_id">

                {{-- GAMBAR --}}
                <div class="form-group">
                    <label class="form-label">Gambar/Foto</label>
                    <div class="image-upload-wrapper">
                        <label class="upload-box" for="product_image">
                            <div class="upload-inside">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none"
                                    stroke="#aaa" stroke-width="1.5" stroke-linecap="round">
                                    <rect x="3" y="3" width="18" height="18" rx="3"/>
                                    <circle cx="8.5" cy="8.5" r="1.5"/>
                                    <path d="M21 15l-5-5L5 21"/>
                                </svg>
                                <span>Upload</span>
                            </div>
                        </label>
                        <input hidden type="file" id="product_image" name="image" accept="image/*">
                        <div class="image-preview" id="imagePreview"></div>
                    </div>
                </div>

                {{-- NAMA PRODUK --}}
                <div class="form-group">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" id="product_name" name="product_name"
                        class="form-input" placeholder="Masukkan nama produk">
                </div>

                {{-- KATEGORI --}}
                <div class="form-group">
                    <label class="form-label">Category Produk</label>
                    <select id="product_category" name="id_category" class="form-input">
                        <option value="">Pilih Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id_category }}">
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- UKURAN --}}
                <div class="form-group hidden" id="sizeSection">
                    <label class="form-label">Ukuran yang tersedia</label>
                    <div class="checkbox-group" id="sizeCheckboxGroup"></div>
                </div>

                {{-- SIZE CHART --}}
                <div class="form-group hidden" id="sizeChartSection">
                    <label class="form-label">Size Chart</label>
                    <div class="size-chart-table" id="sizeChartTable"></div>
                </div>

                {{-- WARNA --}}
                <div class="form-group">
                    <label class="form-label">Warna yang tersedia</label>
                    <div class="tag-input-wrapper" id="colorTagWrapper">
                        <div class="tags-display" id="colorTags"></div>
                        <input type="text" class="tag-input" id="colorInput"
                            placeholder="Ketik warna lalu Enter (cth: White, Red Floral...)">
                    </div>
                    <input type="hidden" name="colors" id="colorsHidden">
                </div>

                {{-- HARGA --}}
                <div class="form-group">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" id="product_price" name="price"
                        class="form-input" placeholder="Contoh: 150000" min="0">
                </div>

                {{-- STOK --}}
                <div class="form-group">
                    <label class="form-label">Stok</label>
                    <input type="number" id="product_stock" name="stock"
                        class="form-input" placeholder="Contoh: 10" min="0">
                </div>

                {{-- STATUS --}}
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select id="product_status" name="status" class="form-input">
                        <option value="Ready">Ready</option>
                        <option value="Out of Stock">Out of Stock</option>
                        <option value="Pre-order">Pre-order</option>
                    </select>
                </div>

                {{-- DESKRIPSI --}}
                <div class="form-group">
                    <label class="form-label">Deskripsi Produk</label>
                    <textarea id="product_description" name="description"
                        class="form-input textarea"
                        placeholder="Masukkan deskripsi produk"></textarea>
                </div>

                <div class="modal-footer-actions">
                    <button type="button" class="btn-action-cancel" id="btnCancelModal">Batal</button>
                    <button type="submit" class="btn-action-save">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== MODAL DELETE ===== --}}
<div class="overlay-details" id="deleteOverlay">
    <div class="delete-modal">
        <h3>Hapus Produk?</h3>
        <p>Produk yang dihapus tidak dapat dikembalikan.</p>
        <div class="delete-actions">
            <button id="cancelDelete">Batal</button>
            <button id="confirmDelete">Hapus</button>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    const SIZECHART_URL = "{{ url('/admin/size-chart') }}";
    const CSRF_TOKEN    = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/page/admin/manageCatalog.js') }}"></script>
@endpush