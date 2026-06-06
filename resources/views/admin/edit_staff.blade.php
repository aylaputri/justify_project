@extends('layouts.admin')

@section('title', 'Edit Staff')

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
                <h1 class="page-title">Edit Akun Staf</h1>
                <p class="page-subtitle">Ubah informasi username, nama lengkap, dan hak akses role untuk akun staf terpilih.</p>
            </div>

            <div class="content-card form-edit-wrapper">
                <form action="{{ route('staffs.update', $staff->id_admin) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group-block">
                        <label for="username" class="form-label-text">Username (Untuk Login)</label>
                        <input type="text" id="username" name="username" class="form-input-control" value="{{ old('username', $staff->username) }}" required>
                        @error('username') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-block">
                        <label for="name" class="form-label-text">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-input-control" value="{{ old('name', $staff->name) }}" required>
                        @error('name') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-block">
                        <label for="role" class="form-label-text">Role / Jabatan</label>
                        <select id="role" name="role" class="form-input-control-select" required>
                            <option value="Super Admin" {{ old('role', $staff->role) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="Staff" {{ old('role', $staff->role) == 'Staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                        @error('role') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-footer-actions">
                        <a href="{{ route('staffs.index') }}" class="btn-form-cancel">Batal</a>
                        <button type="submit" class="btn-form-submit">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </section>
    </section>
</main>

@endsection