@extends('layouts.app')

@section('title', 'Edit Profil')

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/editProfile.css') }}">
@endpush

@section('content')

<header class="header-editProfile">
    <a href="{{ url('/profile') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Edit Profil</h1>
</header>

<main class="edit-body-wrap">
    <div class="edit-body">

        @if(session('success'))
        <div class="alert success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert error-alert">{{ session('error') }}</div>
        @endif

        <form id="profileForm" action="{{ url('/profile/update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="photo-section">
                <div class="photo-wrap" id="photoFrame">
                    @if($user->profile_picture)
                    <img id="photoPreview" src="{{ asset('storage/' . $user->profile_picture) }}" alt="Foto Profil">
                    @else
                    <div class="photo-placeholder" id="photoPlaceholder">👤</div>
                    <img id="photoPreview" src="" alt="Preview Foto" style="display:none;">
                    @endif
                    <div class="photo-edit-btn">
                        <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Z"/></svg>
                    </div>
                </div>
                <span class="photo-label">Tap untuk ganti foto</span>
                <input type="file" id="photoInput" name="profile_picture" accept="image/*">
            </div>

            <div class="section-card">
                <div class="section-title">Informasi Akun</div>
                <div class="field">
                    <label for="fullNameInput">Nama Lengkap</label>
                    <input type="text" id="fullNameInput" name="full_name" value="{{ $user->full_name }}" placeholder="Nama lengkap" required>
                </div>
                <div class="field">
                    <label for="emailInput">Email</label>
                    <input type="email" id="emailInput" name="email" value="{{ $user->email }}" placeholder="Email" required>
                </div>
                <div class="field">
                    <label for="phoneInput">No. HP</label>
                    <input type="tel" id="phoneInput" name="phone_number" value="{{ $user->phone_number }}" placeholder="Contoh: 08xxxxxxxxxx">
                </div>
            </div>

            <div class="section-card">
                <div class="section-title">Ganti Password</div>
                <div class="field">
                    <label for="currentPw">Password Lama</label>
                    <div class="input-wrap">
                        <input type="password" name="current_password" id="currentPw" placeholder="Masukkan password lama">
                        <span class="toggle-pw" data-target="currentPw">
                            <svg class="eye-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label for="newPw">Password Baru</label>
                    <div class="input-wrap">
                        <input type="password" name="new_password" id="newPw" placeholder="Min. 8 karakter">
                        <span class="toggle-pw" data-target="newPw">
                            <svg class="eye-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        </span>
                    </div>
                </div>
                <div class="field">
                    <label for="confirmPw">Konfirmasi Password Baru</label>
                    <div class="input-wrap">
                        <input type="password" name="new_password_confirmation" id="confirmPw" placeholder="Ulangi password baru">
                        <span class="toggle-pw" data-target="confirmPw">
                            <svg class="eye-icon" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                        </span>
                    </div>
                </div>
                <p class="pw-hint">Kosongkan jika tidak ingin ganti password.</p>
            </div>

        </form>
    </div>
</main>

<div class="save-bar">
    <button type="button" class="save-btn" id="btnSubmitProfile">Simpan Perubahan</button>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/page/editProfile.js') }}"></script>
@endpush