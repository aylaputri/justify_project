@extends('layouts.app')

@section('title', 'Reset Password')

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
                    Reset Password
                </h1>

                <p class="auth-subtitle">
                    Create your new password.
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
                    action="/reset-password/{{ $token }}">

                    @csrf

                    <!-- PASSWORD -->
                    <div class="input-group">

                        <label class="input-label">
                            New Password
                        </label>

                        <div class="password-wrapper">

                            <input
                                type="password"
                                name="password"
                                placeholder="Enter new password"
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

                        @error('password')

                        <p class="field-error">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                    <!-- CONFIRM PASSWORD -->
                    <div class="input-group">

                        <label class="input-label">
                            Confirm Password
                        </label>

                        <div class="password-wrapper">

                            <input
                                type="password"
                                name="password_confirmation"
                                placeholder="Confirm new password"
                                class="input-field"
                                id="passwordConfirmation">

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="submit-button">

                        Save Password

                    </button>

                </form>

                <div class="auth-footer-link">

                    <a href="/login">
                        Back to Login
                    </a>

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="auth-right">

            <img
                src="{{ asset('assets/image/gambar-login.jpeg') }}"
                alt="Reset Password Image"
                class="auth-image">

        </div>

    </section>

</main>

@endsection