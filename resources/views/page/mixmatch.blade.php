@extends('layouts.app')

@section('title', 'mixmatch')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
<link rel="stylesheet" href="{{ asset('css/page/mixmatch.css') }}" >

@endpush

@section('content')

<header>
        <nav class="navbar">
            <div class="nav-container">
                <div class="logo">
                    <img src="{{ asset('image/Logo-Putih-Savior-World.png') }}">
                </div>
    
                <!--Tampilan mobile-->
                <div class="hamburger" onclick="toggleMenu()">
                    <img id="burger" src="{{ asset('image/icon/icon-burger.svg') }}">
                </div>
    
                <!--Tampilan Dekstop-->
                <div class="menu-desktop">
                    <a href="{{ url('/home') }}">Home</a>
                    <a href="{{ url('/katalog') }}">Catalog</a>
                    <a href="{{ url('/mixmatch') }}">Mix & Match</a>
                </div>
            </div>
        </nav>
    
        <!-- OVERLAY MENU MOBILE -->
        <div class="backdrop" id="backdrop" onclick="toggleMenu()"></div> <!-- Biar background gelap saat buka overlay -->
        <div class="overlay" id="overlay">
            <div class="close" onclick="toggleMenu()">
                <img src="{{ asset('image/icon/icon-close-putih.svg') }}">
            </div>
    
            <div class="menu-overlay">
               <a href="{{ url('/home') }}">Home</a>
               <a href="{{ url('/katalog') }}">Catalog</a>
               <a href="{{ url('/mixmatch') }}">Mix & Match</a>
            </div>
        </div>
    </header>

    <main>
<div class="mix-match-wrapper">
    
    <div id="guide-box" class="guide-box">
        <h3>🛠️ Panduan Menggunakan Mix & Match</h3>
        <div id="guide-text">
            <p id="step-1"><strong>1. Pilih Karakter Utama</strong><br>Klik salah satu card di bawah untuk memulai.</p>
            <div id="step-2" class="hidden-content">
                <p><strong>2. Eksperimen Gaya</strong><br>Pilih atasan di kiri dan bawahan di kanan. Klik item untuk melihat detail produk.</p>
            </div>
        </div>
    </div>

    <div class="main-content-layout">
        
        <div id="col-left" class="side-panel hidden">
            <h4>Atasan</h4>
            <div class="scroll-container">
                <div class="item-card" onclick="selectItem(this, 'Kemeja Black', 'Rp 189k')">
                    <img src="{{ asset('assets/image/imgMixmatch/mancard.jpeg') }}">
                </div>
                <div class="item-card" onclick="selectItem(this, 'White Tee', 'Rp 120k')">
                    <img src="{{ asset('assets/image/item/top2.png') }}">
                </div>
            </div>
        </div>

        <div class="display-area">
            
            <div id="gender-select-row" class="gender-row">
                <div class="card-option shadow-v3" onclick="startMixMatch('male')">
                    <img src="{{ asset('assets/image/imgMixmatch/mancard.jpeg') }}">
                    <h3>Pria</h3>
                </div>
                <div class="card-option shadow-v3" onclick="startMixMatch('female')">
                    <img src="{{ asset('assets/image/imgMixmatch/womancard.jpeg') }}">
                    <h3>Wanita</h3>
                </div>
            </div>

            <div id="active-model-frame" class="hidden">
                <div class="main-model-card shadow-v3">
                    <button class="btn-switch" onclick="location.reload()">🔄 Ganti Gender</button>
                    <img id="model-img" src="">
                </div>
            </div>
        </div>

        <div id="col-right-group" class="side-panel-group hidden">
            <div class="side-panel">
                <h4>Bawahan</h4>
                <div class="scroll-container">
                    <div class="item-card" onclick="selectItem(this, 'Chino Grey', 'Rp 210k')">
                        <img src="{{ asset('assets/image/item/bot1.png') }}">
                    </div>
                </div>
            </div>

            <div id="product-info-box" class="info-card-black hidden">
                <h4 id="p-title">Detail</h4>
                <p id="p-price">-</p>
                <hr>
                <a href="#" class="katalog-link">Ke Katalog →</a>
            </div>
        </div>

    </div>
</div>              
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="footer-container">
            <div class="footer-section brand-section">
                <h3 class="footer-title">BRAND</h3>
                <img src="../image/Logo-Putih-Savior-World.png" alt="Savior World Logo Putih">
                <p>Penyelamat Hidupmu!</p>
            </div>
    
            <div class="footer-section social-section">
                <h3 class="footer-title">FOLLOW US</h3>
    
                <div class="social-icons">
                    <a href="https://www.instagram.com/svr.wrld/">
                        <img src="../image/icon/icon_instagram.svg" alt="Instagram">
                    </a>
                    <a href="https://shopee.co.id/eldinosaurrawr?entryPoint=ShopBySearch&searchKeyword=savior%20world">
                        <img src="../image/icon/icon_shopee.svg" alt="Shopee">
                    </a>
                </div>
            </div>
    
            <div class="footer-section contact-section">
                <h3 class="footer-title">CONTACT</h3>
                <p>Email @savior.com</p>
                <p>Whatsapp +62 858 7162 6545</p>
            </div>
        </div>
    
        <div class="footer-bottom">
            <p>Copyright &copy; JustifySvr2026</p>
        </div>
    </footer>

    @endsection

    @push('scripts')
    <script src="{{asset ('js/page/katalog.js') }}"></script>
    @endpush