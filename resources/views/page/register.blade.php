@extends('layouts.app')

@section('title', 'Register')

@push('style')

<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" />

<link
    rel="stylesheet"
    href="{{ asset('css/page/auth.css') }}">

@endpush

@section('content')

<main class="auth-page">

    <section class="auth-container">

        <!-- LEFT -->
        <div class="auth-left">

            <div class="auth-box">

                <!-- LOGO -->
                <img
                    src="{{ asset('assets/image/Logo-Hitam-Savior-World.png') }}"
                    alt="Logo Savior World"
                    class="auth-logo">

                <!-- TITLE -->
                <h1 class="auth-title">
                    Sign Up
                </h1>

                <p class="auth-subtitle">
                    Don't have an account? <a href="/login">Log In</a>
                </p>

                <!-- ERROR -->
                @if(session('error'))

                <div class="error-message">
                    {{ session('error') }}
                </div>

                @endif

                <!-- FORM -->
                <form
                    method="POST"
                    action="/login">

                    @csrf

                    <!-- FULL NAME -->
                    <div class="input-group">

                        <label class="input-label">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="fullName"
                            placeholder="Enter your full name"
                            class="input-field"
                            id="fullName">

                    </div>

                    <!-- EMAIL -->
                    <div class="input-group">

                        <label class="input-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            placeholder="Enter your email"
                            class="input-field"
                            id="email">

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

                                <img
                                    src="{{ asset('assets/icon/mata-ketutup-hitam.svg') }}"
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
                        class="submit-button"
                        id="submitButton"
                        disabled>

                        Log In

                    </button>

                </form>

                <!-- DIVIDER -->
                <div class="divider">
                    <span>Or</span>
                </div>

                <!-- GOOGLE -->
                <a href="#" class="google-button">
                    <img src="{{ asset('assets/icon/google.svg') }}" alt="Google">
                    Continue with Google
                </a>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="auth-right">

            <img
                src="{{ asset('assets/image/gambar-login.jpeg') }}"
                alt="Login Image"
                class="auth-image">

        </div>

    </section>

</main>

@endsection

@push('scripts')

<script src="{{ asset('js/page/auth.js') }}"></script>

@endpush