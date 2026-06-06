@extends('layouts.admin')

@section('title', 'Edit Staff')

@push('style')
<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/staffs.css') }}">
@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <div class="staff-header-block">
                <h1 class="page-title">Edit Akun Staf</h1>
                <p class="page-subtitle">Ubah informasi nama, hak akses role, status, serta detail deskripsi perizinan untuk akun staf terpilih.</p>
            </div>

            <div class="content-card form-edit-wrapper">
                
                <form action="{{ route('staffs.update', $staff->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group-block">
                        <label for="name" class="form-label-text">Nama Lengkap</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $staff->name) }}" 
                            class="form-input-control" 
                            required
                        >
                        @error('name') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-block">
                        <label for="role" class="form-label-text">Role / Jabatan</label>
                        <select id="role" name="role" class="form-input-control-select" required>
                            <option value="Super Admin" {{ old('role', $staff->role) == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="Staf" {{ old('role', $staff->role) == 'Staf' ? 'selected' : '' }}>Staf</option>
                        </select>
                        @error('role') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-block">
                        <label for="status" class="form-label-text">Status Akun</label>
                        <select id="status" name="status" class="form-input-control-select" required>
                            <option value="Aktif" {{ old('status', $staff->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Non Aktif" {{ old('status', $staff->status) == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                        @error('status') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group-block">
                        <label for="permissions" class="form-label-text">Izin Akses (Permissions Code)</label>
                        <textarea 
                            id="permissions" 
                            name="permissions" 
                            rows="4" 
                            class="form-input-control-textarea" 
                            placeholder="Contoh: zzzzzzzzz"
                            required>{{ old('permissions', $staff->permissions) }}</textarea>
                        @error('permissions') <span class="error-msg">{{ $message }}</span> @enderror
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