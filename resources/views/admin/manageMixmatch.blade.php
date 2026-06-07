@extends('layouts.admin')

@section('title', 'Manage Mixmatch')

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
                Manage Mix & Match
            </h1>

            @if(session('success'))
                <div class="alert alert-success">
                    🎉 {{ session('success') }}
                </div>
            @endif

            <div class="content-card">
                
                <div class="card-header-mixmatch">
                    <h3>Daftar Koleksi Pakaian Maneken</h3>
                    <a href="{{ route('admin.manageMixmatch.create') }}" class="btn-tambah-data" onclick="toggleModal('modal-tambah')">
                        + Tambah Baju Baru
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="mixmatch-table">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Pakaian</th>
                                <th>Gender</th>
                                <th>Kategori</th>
                                <th>ID Katalog Terhubung</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse($products as $prod)
                           <tr>
                                <td>
                                    <img src="{{ asset($prod->image_url) }}" alt="{{ $prod->product_name }}" class="img-preview">
                                </td>
                                <td class="product-name">{{ $prod->product_name }}</td>
                                <td>
                                    <span class="badge-mix badge-{{ $prod->gender == 'Laki-laki' ? 'male' : 'female' }}">
                                    {{ $prod->gender }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-mix badge-atasan">
                                        {{ $prod->id_category == 2 ? 'Atasan' : 'Bawahan' }}
                                    </span>
                                </td>
                                <td>{{ $prod->id_product }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.manageMixmatch.edit', $prod->id_product) }}" class="btn-action-edit">Edit</a>
        
                                    <form action="{{ route('admin.manageMixmatch.destroy', $prod->id_product) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="table-empty">
                                    Belum ada koleksi pakaian Mix & Match. Klik tombol "+ Tambah Baju Baru" untuk memasukkan data.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </section>

    </section>
</main>

<div id="modal-tambah" class="modal-backdrop">
    <div class="modal-box">
        <div class="modal-header">
            <h3>👕 Tambah Baju Maneken Baru</h3>
            <button type="button" class="btn-close-modal" onclick="toggleModal('modal-tambah')">&times;</button>
        </div>
        
        <form action="{{ route('admin.manageMixmatch.store') }}" method="POST" enctype="multipart/form-data" class="form-mixmatch">
            @csrf
            <div class="form-group">
                <label>Nama Pakaian</label>
                <input type="text" name="name" placeholder="Contoh: Over-sized Flannel Shirt" required>
            </div>
            <div class="form-group">
                <label>Target Gender Maneken</label>
                <select name="gender" required>
                    <option value="male">Pria (Male)</option>
                    <option value="female">Wanita (Female)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Kategori Pakaian</label>
                <select name="category" required>
                    <option value="atasan">Atasan</option>
                    <option value="bawahan">Bawahan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Hubungkan ke ID Katalog Jualan (Opsional)</label>
                <input type="number" name="katalog_id" placeholder="Masukkan ID database produk katalog utama">
            </div>
            <div class="form-group">
                <label>File Gambar Baju <strong class="text-danger">(WAJIB PNG TRANSPARAN)</strong></label>
                <input type="file" name="image" accept="image/png" required>
            </div>
            <button type="submit" class="btn-submit-mixmatch">🚀 Simpan & Tayangkan</button>
        </form>
    </div>
</div>
@endsection

@push('script')
<script src="{{ asset('js/page/admin/manageMixmatch.js') }}"></script>
@endpush