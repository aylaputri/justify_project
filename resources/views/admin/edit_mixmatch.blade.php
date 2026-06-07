@extends('layouts.admin')

@section('title', 'Edit Mixmatch')

@push('style')
<link rel="stylesheet" href="{{ asset('css/page/admin/manageMixmatch.css') }}">
<link rel="stylesheet" href="{{ asset('css/page/admin/editMixmatch.css') }}">
@endpush

@section('content')
<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <div>
                <a href="{{ route('admin.manageMixmatch.index') }}" class="btn-back-link">
                    ← Kembali ke Dashboard Mixmatch
                </a>
            </div>

            <h1 class="page-title">Edit Pakaian</h1>

            <div class="content-card">
                
                <div class="card-header-mixmatch">
                    <h3>Mengubah Data: <span style="color: #3b82f6;">{{ $product->product_name }}</span></h3>
                </div>

                <div class="form-card-mix">
                    
                    <form action="{{ route('admin.manageMixmatch.update', $product->id_product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group-mix">
                            <label>Nama Pakaian</label>
                            <input type="text" name="product_name" value="{{ $product->product_name }}" required>
                        </div>

                        <div class="form-group-mix">
                            <label>Kategori Pakaian</label>
                            <select name="id_category" required>
                                <option value="2" {{ $product->id_category == 2 ? 'selected' : '' }}>Atasan</option>
                                <option value="3" {{ $product->id_category == 3 ? 'selected' : '' }}>Bawahan</option>
                            </select>
                        </div>

                        <div class="form-group-mix">
                            <label>Target Gender Maneken</label>
                            <select name="gender" required>
                                <option value="Laki-laki" {{ $product->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $product->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group-mix">
                            <label>Gambar Pakaian Saat Ini</label>
                            <div class="img-preview-container">
                                <img src="{{ asset($product->image_url) }}" alt="{{ $product->product_name }}" class="img-preview-edit">
                            </div>
                            
                            <label style="margin-top: 15px;">Ganti Gambar Baru</label>
                            <input type="file" name="image" accept="image/*">
                            <small class="file-input-hint">*Kosongkan saja jika tidak ingin mengubah gambar pakaian.</small>
                        </div>

                        <div style="margin-top: 30px;">
                            <button type="submit" class="btn-submit-mix">
                                💾 Simpan Perubahan Baju
                            </button>
                        </div>
                    </form>

                </div>

            </div>

        </section>

    </section>
</main>
@endsection

@push('script')
<script src="{{ asset('js/page/admin/manageMixmatch.js') }}"></script>
@endpush