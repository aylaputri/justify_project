@extends('layouts.app')

@section('title', 'Metode Pembayaran')

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/paymentMethod.css') }}">
@endpush

@section('content')

<header class="header-payment">
    <a href="{{ url('/profile') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Metode Pembayaran</h1>
</header>

<main class="pay-body-wrap">
    <div class="pay-body">

        <div class="info-box">
            <svg fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
            <p>Pembayaran diproses saat checkout. Pilih metode yang tersedia di halaman pembayaran sesuai kenyamanan kamu.</p>
        </div>

        <div class="section-card">
            <div class="section-title">Transfer Bank</div>

            <div class="pay-item">
                <div class="pay-icon">🏦</div>
                <div class="pay-info">
                    <div class="pay-name">BCA</div>
                    <div class="pay-detail">Virtual Account · otomatis terverifikasi</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>

            <div class="pay-item">
                <div class="pay-icon">🏦</div>
                <div class="pay-info">
                    <div class="pay-name">BNI</div>
                    <div class="pay-detail">Virtual Account · otomatis terverifikasi</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>

            <div class="pay-item">
                <div class="pay-icon">🏦</div>
                <div class="pay-info">
                    <div class="pay-name">BRI</div>
                    <div class="pay-detail">Virtual Account · otomatis terverifikasi</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>

            <div class="pay-item">
                <div class="pay-icon">🏦</div>
                <div class="pay-info">
                    <div class="pay-name">Mandiri</div>
                    <div class="pay-detail">Bill Payment · otomatis terverifikasi</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>

            <div class="pay-item">
                <div class="pay-icon">🏦</div>
                <div class="pay-info">
                    <div class="pay-name">Permata</div>
                    <div class="pay-detail">Virtual Account · otomatis terverifikasi</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">E-Wallet</div>

            <div class="pay-item">
                <div class="pay-icon">💚</div>
                <div class="pay-info">
                    <div class="pay-name">GoPay</div>
                    <div class="pay-detail">Scan QR atau link akun GoPay</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>

            <div class="pay-item">
                <div class="pay-icon">🔵</div>
                <div class="pay-info">
                    <div class="pay-name">ShopeePay</div>
                    <div class="pay-detail">Scan QR atau link akun ShopeePay</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>

            <div class="pay-item">
                <div class="pay-icon">🟣</div>
                <div class="pay-info">
                    <div class="pay-name">DANA</div>
                    <div class="pay-detail">Scan QR atau link akun DANA</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>

            <div class="pay-item">
                <div class="pay-icon">🔴</div>
                <div class="pay-info">
                    <div class="pay-name">OVO</div>
                    <div class="pay-detail">Scan QR atau link akun OVO</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>
        </div>

        <div class="section-card">
            <div class="section-title">Lainnya</div>

            <div class="pay-item">
                <div class="pay-icon">🏪</div>
                <div class="pay-info">
                    <div class="pay-name">Alfamart / Indomaret</div>
                    <div class="pay-detail">Bayar tunai di minimarket terdekat</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>

            <div class="pay-item">
                <div class="pay-icon">💳</div>
                <div class="pay-info">
                    <div class="pay-name">Kartu Kredit / Debit</div>
                    <div class="pay-detail">Visa, Mastercard, JCB</div>
                </div>
                <span class="pay-badge">Tersedia</span>
            </div>
        </div>

    </div>
</main>

@endsection