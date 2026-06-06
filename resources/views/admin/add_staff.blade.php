@extends('layouts.admin')

@section('title', 'Tambah Staff')

@push('style')
<link rel="stylesheet" href="{{ asset('css/page/admin/staffs.css') }}">
@endpush

@section('content')

<main class="dashboard-page">
    @include('components.admin.sidebar')

    <section class="dashboard-content">
        @include('components.admin.topbar')

        <section class="page-content">
            <div class="staff-header-block">
                <h1 class="page-title">Tambah Akun Staf Baru</h1>
                <p class="page-subtitle">Buat akun administrasi baru untuk mengelola katalog, pesanan, dan laporan sistem.</p>
            </div>

            <div class="content-card form-edit-wrapper">
                <form action="{{ route('staffs.store') }}" method="POST">
                    @csrf

                    <div class="form-group-block">
                        <label for="username" class="form-label-text">Username (Digunakan untuk Login)</label>
                        <input type="text" id="username" name="username" class="form-input-control" value="{{ old('username') }}" placeholder="Contoh: yuyun_admin" required>
                        @error('username') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-block">
                        <label for="name" class="form-label-text">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-input-control" value="{{ old('name') }}" placeholder="Contoh: Yuyun Setyawati" required>
                        @error('name') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-block">
                        <label for="password" class="form-label-text">Password Akun</label>
                        <input type="password" id="password" name="password" class="form-input-control" placeholder="Masukkan password minimal 6 karakter" required>
                        @error('password') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-block">
                        <label for="role" class="form-label-text">Role / Jabatan</label>
                        <select id="role" name="role" class="form-input-control-select" required>
                            <option value="" disabled selected>-- Pilih Role --</option>
                            <option value="Super Admin" {{ old('role') == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('role') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-footer-actions">
                        <a href="{{ route('staffs.index') }}" class="btn-form-cancel">Batal</a>
                        <button type="submit" class="btn-form-submit">Daftarkan Staf</button>
                    </div>
                </form>
            </div>
        </section>
    </section>
</main>

@endsection