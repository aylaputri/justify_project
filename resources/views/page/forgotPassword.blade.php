@extends('layouts.app')

@section('title', 'Forgot Password')

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
                    Forgot Password
                </h1>

                <p class="auth-subtitle">
                    Enter your email and we'll send you a reset link.
                </p>

                <!-- ERROR -->
                @if(session('error'))

                <div class="error-message">
                    {{ session('error') }}
                </div>

                @endif

                <!-- SUCCESS -->
                @if(session('success'))

                <div class="success-message">
                    {{ session('success') }}
                </div>

                @endif

                <!-- FORM -->
                <form
                    method="POST"
                    action="/forgot-password">

                    @csrf

                    <!-- EMAIL -->
                    <div class="input-group">

                        <label class="input-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            class="input-field"
                            id="email">

                        @error('email')

                        <p class="field-error">
                            {{ $message }}
                        </p>

                        @enderror

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="submit-button"
                        id="submitButton">

                        Send Reset Link

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
                alt="Forgot Password Image"
                class="auth-image">

        </div>

    </section>

</main>

@endsection

@push('scripts')

<script src="{{ asset('js/page/auth.js') }}"></script>

@endpush