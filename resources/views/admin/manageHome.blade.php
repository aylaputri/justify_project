@extends('layouts.admin')

@section('title', 'Manage Home')

@push('style')
<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/manageHome.css') }}">
@endpush

@section('content')

<main class="dashboard-page"
    id="dashboard-main"
    data-success="{{ session('success') }}" 
    data-error="{{ session('error') }}">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">
            <div class="staff-header-block">
                <h1 class="page-title">Manage Home Content</h1>
                <p class="page-subtitle">Modifikasi konten landing page utama Savior World secara real-time.</p>
            </div>

            <div class="content-card card-spacer">
                <div class="manage-home-wrapper">
                    <h2 class="section-card-title">1. Hero Banner Segment</h2>
                    <p class="section-card-desc">Atur gambar latar belakang, teks jargon utama, dan link tombol aksi.</p>
        
                    <form action="{{ route('admin.home.update-hero') }}" method="POST" enctype="multipart/form-data" class="manage-home-form">
                        @csrf <div class="form-grid-two-cols">
                            <div>
                                <label class="form-label-styled">Jargon Utama (Headline)</label>
                                <input type="text" name="hero_headline" value="{{ session('hero_headline', 'MIX YOUR STYLE YOUR WAY') }}" class="form-input-text">
                            </div>
                            <div>
                                <label class="form-label-styled">Link Tombol Action</label>
                                <input type="text" name="hero_button_link" value="{{ session('hero_button_link', '/mix-and-match') }}" class="form-input-text">
                            </div>
                        </div>
                        <div class="form-group-file">
                            <label class="form-label-styled">Ganti Gambar Banner Hero (Rekomendasi Landscape/Wide)</label>
                            <input type="file" name="hero_image" accept="image/*, .jfif" class="form-input-file">
                        </div>
                        <button type="submit" class="btn-submit-primary">Simpan Perubahan Banner</button>
                    </form>
                </div>
            </div>

            <div class="content-card card-spacer">
                <div class="manage-home-wrapper">
                    <h2 class="section-card-title">2. Visi & Misi Segment</h2>
                    <p class="section-card-desc">Gunakan tanda baru (Enter) untuk memisahkan setiap poin list.</p>
                    
                    <form action="{{ route('admin.home.update-visimisi') }}" method="POST" class="manage-home-form">
                        @csrf <div class="form-grid-two-cols">
                            <div>
                                <label class="form-label-styled">Poin-Poin VISI</label>
                                <textarea name="visi_points" rows="5" class="form-input-textarea" placeholder="Tulis poin visi di sini...">{{ session('visi_points', "Drop fit yang relate sama lifestyle Gen Z\nBikin styling jadi fun lewat mix & match\nStay ahead tapi gak kehilangan identitas\nSupport self-expression tanpa batas") }}</textarea>
                            </div>
                            <div>
                                <label class="form-label-styled">Poin-Poin MISI</label>
                                <textarea name="misi_points" rows="5" class="form-input-textarea" placeholder="Tulis poin misi di sini...">{{ session('misi_points', "Drop fit yang relate sama lifestyle Gen Z\nBikin styling jadi fun lewat mix & match\nStay ahead tapi gak kehilangan identitas\nSupport self-expression tanpa batas") }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn-submit-primary">Update Visi & Misi</button>
                    </form>
                </div>
            </div>

            <div class="content-card">
                <div class="manage-home-wrapper">
                    <h2 class="section-card-title">3. Our Gallery / Lookbook</h2>
                    <p class="section-card-desc">Unggah dan kelola foto-foto estetis tren fashion di halaman depan.</p>
                    
                    <form action="{{ route('admin.home.upload-gallery') }}" method="POST" enctype="multipart/form-data" class="manage-home-form gallery-form-border">
                        @csrf
                        <label class="form-label-styled">Tambah Foto Gallery Baru (Bisa pilih banyak foto)</label>
                        <div class="gallery-upload-row">
                            <input type="file" name="gallery_files[]" id="gallery_files" multiple accept="image/*, .jfif" class="form-input-file">
                            <button type="submit" class="btn-upload-secondary">+ Upload Gambar</button>
                        </div>
                    </form>

                    <label class="form-label-styled" style="margin-bottom: 12px;">Foto yang Sedang Aktif di Website (Swipe Section):</label>
                    <div class="gallery-preview-grid">
                        @forelse ($galleryFiles as $fileName)
                        <div class="gallery-item-card">
                            <div class="gallery-image-placeholder" style="background: url('{{ asset('image/Foto/' . $fileName) }}') center/cover no-repeat; height: 150px;">
                            </div>
 
                            <form action="{{ route('admin.home.delete-gallery', $fileName) }}" method="POST" onsubmit="return confirm('Yakin hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-gallery">Hapus</button>
                            </form>
                        </div>
                        @empty
                            <p style="font-size: 13px; color: #999; padding: 10px;">Belum ada foto lookbook di folder.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

    </section>

</main>
<script src="{{ asset('js/page/admin/manageHome.js') }}"></script>
@endsection