@extends('layouts.app')

@section('title', 'home')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
<link rel="stylesheet" href="{{ asset('css/page/home.css') }}" >

@endpush

@section('content')

<header>
            <nav class="navbar">
                <div class="nav-container">
                    <div class="logo">
                        <img src="{{ asset('image/Logo-Putih-Savior-World.png') }}">
                    </div>

                    <!-- MENU MOBILE -->
                    <div class="hamburger" onclick="toggleMenu()">
                        <img id="burger" src="{{ asset('image/icon/icon-burger.svg') }}">
                    </div>

                    <!-- MENU DESKTOP -->
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

        <!-- ISI HOME -->
        <main>
            <!-- HERO -->
            <section class="hero">
                <img src="image/Foto/Gambar-kolase-cewe.jpg" alt="Hero Image">

                <div class="hero-text">
                    <h1>MIX YOUR STYLE <br> YOUR WAY</h1>
                </div>

                <button class="hero-button">
                    <a href="html/mixmatch.html">Start Mix & Match ></a>
                </button>
            </section>

            <!-- ABOUT -->
            <section class="about">
                <h2>ABOUT SAVIOR WORLD</h2>

                <div class="card">
                    <h3>VISI</h3>
                    <ul>
                        <li>Drop fit yang relate sama lifestyle Gen Z</li>
                        <li>Bikin styling jadi fun lewat mix & match</li>
                        <li>Stay ahead tapi gak kehilangan identitas</li>
                        <li>Support self-expression tanpa batas</li>
                    </ul>
                </div>

                <div class="card">
                    <h3>MISI</h3>
                    <ul>
                        <li>Drop fit yang relate sama lifestyle Gen Z</li>
                        <li>Bikin styling jadi fun lewat mix & match</li>
                        <li>Stay ahead tapi gak kehilangan identitas</li>
                        <li>Support self-expression tanpa batas</li>
                    </ul>
                </div>
            </section>  
            
            <!-- GALLERY -->
            <section class="gallery">
                <h2>OUR GALLERY</h2>
                <p>Swipe here</p>
                
                <div class="gallery-container">
                    <img src="image/Foto/Gambar-cewe-depan-bajucoklat.jpg" alt="Gallery gambar bagian depan">
                    <img src="image/Foto/Gambar-cewe-belakang-bajucoklat.jpg" alt="Gallery gambar bagian belakang">
                    <img src="image/Foto/Gambar-cewe-samping-bajucoklat.jpg" alt="Gallery gambar bagian samping">
                </div>
            </section>
        </main>

        <!-- FOOTER -->
        <footer>
            <div class="footer-container">
                <div class="footer-section brand-section">
                    <h3 class="footer-title">BRAND</h3>
                    <img src="image/Logo-Putih-Savior-World.png" alt="Savior World Logo Putih">
                    <p>Penyelamat Hidupmu!</p>
                </div>

                <div class="footer-section social-section">
                    <h3 class="footer-title">FOLLOW US</h3>

                    <div class="social-icons">
                        <a href="https://www.instagram.com/svr.wrld/">
                            <img src="image/icon/icon_instagram.svg" alt="Instagram">
                        </a>
                        <a href="https://shopee.co.id/eldinosaurrawr?entryPoint=ShopBySearch&searchKeyword=savior%20world">
                            <img src="image/icon/icon_shopee.svg" alt="Shopee">
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