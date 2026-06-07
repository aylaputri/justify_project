@extends('layouts.admin')

@section('title', 'Tambah Mixmatch')

@push('style')
<link rel="stylesheet" href="{{ asset('css/page/admin/manageMixmatch.css') }}">
@endpush

@section('content')
<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <h1 class="page-title">
                Tambah Baju Baru
            </h1>

            <div class="content-card">
                
                <div class="card-header-mixmatch">
                    <h3>Form Pendaftaran Koleksi Pakaian</h3>
                    <a href="{{ route('admin.manageMixmatch.index') }}" class="btn-tambah-data" style="text-decoration: none; background: #6b7280;">
                        ← Kembali ke List
                    </a>
                </div>

                <div style="padding: 20px;">
                    <form action="{{ route('admin.manageMixmatch.store') }}" method="POST" enctype="multipart/form-data" class="form-mixmatch">
                        @csrf
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Nama Pakaian</label>
                            <input type="text" name="product_name" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Kategori</label>
                            <select name="id_category" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                <option value="2">Atasan </option>
                                <option value="3">Bawahan </option>
                            </select>
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Gender</label>
                            <select name="gender" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group" style="margin-bottom: 20px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Harga (Rp)</label>
                            <input type="number" name="price" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
                        </div>

                        <div class="form-group" style="margin-bottom: 30px;">
                            <label style="display: block; margin-bottom: 8px; font-weight: bold;">Gambar (PNG Transparan)</label>
                            <input type="file" name="image" accept="image/*" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; background: #f9f9f9;">
                        </div>

                        <button type="submit" class="btn-submit-mixmatch" style="border: none; cursor: pointer; width: auto; padding: 12px 30px;">
                            🚀 Simpan & Tayangkan
                        </button>
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