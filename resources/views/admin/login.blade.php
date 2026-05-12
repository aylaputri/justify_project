@extends('layouts.app')

@section('title', 'Admin Login')

@push('style')

<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" />

<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/login.css') }}">

@endpush

@section('content')

<main class="login-page">

    <section class="login-container">

        <!-- LEFT -->
        <div class="login-left">

            <div class="login-box">

                <!-- LOGO -->
                <img
                    src="{{ asset('assets/image/Logo-Putih-Savior-World.png') }}"
                    alt="Logo Savior World"
                    class="login-logo">

                <!-- TITLE -->
                <h1 class="login-title">
                    Log In Admin
                </h1>

                <!-- ERROR -->
                @if(session('error'))

                <div class="error-message">
                    {{ session('error') }}
                </div>

                @endif

                <!-- FORM -->
                <form
                    method="POST"
                    action="/admin/login"
                    id="loginForm">

                    @csrf

                    <!-- USERNAME -->
                    <div class="input-group">

                        <label class="input-label">
                            Username
                        </label>

                        <input
                            type="text"
                            name="username"
                            placeholder="Enter your username"
                            class="input-field"
                            id="username">

                    </div>

                    <!-- PASSWORD -->
                    <div class="input-group">

                        <label class="input-label">
                            Password
                        </label>

                        <div class="password-wrapper">

                            <input
                                type="password"
                                name="password"
                                placeholder="Enter your password"
                                class="input-field"
                                id="password">

                            <button
                                type="button"
                                class="toggle-password"
                                id="togglePassword">

                                <!-- GANTI NANTI ICONNYA -->
                                <img
                                    src="{{ asset('assets/icon/mata-ketutup-putih.svg') }}"
                                    alt="Toggle Password"
                                    class="eye-icon"
                                    id="eyeIcon">

                            </button>

                        </div>

                    </div>

                    <!-- FORGOT -->
                    <div class="forgot-password">

                        <a href="#">
                            Forgot Password ?
                        </a>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="login-button"
                        id="loginButton"
                        disabled>
                        Log In
                    </button>

                </form>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="login-right">

            <!-- GANTI NANTI FOTO LOGIN -->
            <img
                src="{{ asset('assets/image/gambar-login.jpeg') }}"
                alt="Login Image"
                class="login-image">

        </div>

    </section>

</main>

@endsection

@push('scripts')

<script src="{{ asset('js/page/admin/login.js') }}"></script>

@endpush