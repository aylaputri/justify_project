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
                    <a href="../index.html">Home</a>
                    <a href="catalog.html">Catalog</a>
                    <a href="mixmatch.html">Mix & Match</a>
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
                <a href="../index.html">Home</a>
                <a href="catalog.html">Catalog</a>
                <a href="mixmatch.html">Mix & Match</a>
            </div>
        </div>
    </header>

    <main>
        <div class="mixmatch-container">
            <div class="guide-card">
                <h3>✨ Cara Pakai Mix & Match</h3>
                <p>Ikuti langkah mudah ini untuk melihat gaya barumu:</p>
                <ul>
                    <li>Klik satu gambar di bagian <b>Atasan</b>.</li>
                    <li>Klik satu gambar di bagian <b>Bawahan</b>.</li>
                    <li>Klik tombol <b>Mix</b> untuk menggabungkan!</li>
                </ul>
            </div>

            <div id="result-display" class="result-area">
                <h3 class="result_title">Your Style Concept:</h3>
                <div id="combined-preview" class="preview-box"></div>
                <hr class="result-divider">
            </div>

            <section class="selection-section">
                <h4>ATASAN</h4>
                <div class="items-grid">
                    <img src="../image/Foto/img_mixmatch_atasan2.jpg" class="item-choice atasan" onclick="pilihItem(this, 'atasan')">
                    <img src="../image/Foto/img_mixmatch_atasan.jpg" class="item-choice atasan" onclick="pilihItem(this, 'atasan')">
                    <img src="../image/Foto/img_mixmatch_atasan3.jpg" class="item-choice atasan" onclick="pilihItem(this, 'atasan')">
                    <img src="../image/Foto/img_mixmatch_atasan4.jpg" class="item-choice atasan" onclick="pilihItem(this, 'atasan')">
                    <img src="../image/Foto/img_mixmatch_atasan2.jpg" class="item-choice atasan" onclick="pilihItem(this, 'atasan')">
                    <img src="../image/Foto/img_mixmatch_atasan2.jpg" class="item-choice atasan" onclick="pilihItem(this, 'atasan')">
                </div>
            </section>

            <section class="selection-section">
                <h4>BAWAHAN</h4>
                <div class="items-grid">
                    <img src="../image/Foto/img_mixmatch_bawahan.jpg" class="item-choice bawahan" onclick="pilihItem(this, 'bawahan')">
                    <img src="../image/Foto/img_mixmatch_bawahan2.jpg" class="item-choice bawahan" onclick="pilihItem(this, 'bawahan')">
                    <img src="../image/Foto/img_mixmatch_bawahan3.jpg" class="item-choice bawahan" onclick="pilihItem(this, 'bawahan')">
                    <img src="../image/Foto/img_mixmatch_bawahan4.jpg" class="item-choice bawahan" onclick="pilihItem(this, 'bawahan')">
                    <img src="../image/Foto/img_mixmatch_bawahan5.jpg" class="item-choice bawahan" onclick="pilihItem(this, 'bawahan')">
                    <img src="../image/Foto/img_mixmatch_bawahan.jpg" class="item-choice bawahan" onclick="pilihItem(this, 'bawahan')">
                </div>
            </section>

            <div class="action-area">
                <button class="btn-mix" onclick="gabungkanStyle()">Mix</button>
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