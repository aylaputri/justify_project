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
        <div class="mixmatch-container">
            <div class="guide-card">
                <h3>✨ Panduan Mix & Match</h3>
                <p id="instruction-text">Silahkan pilih Karakter Utama untuk memulai petualangan gayamu.</p>
            </div>
            <div id="gender-step" class="selection-wrapper">
            <div class="gender-card" onclick="initApp('male')">
                <img src="{{ asset('assets/image/imgMixmatch/pria/mancard.jpeg') }}" alt="Male">
                <p>MALE CHARACTER</p>
            </div>
            <div class="gender-card" onclick="initApp('female')">
                <img src="{{ asset('assets/image/imgMixmatch/wanita/womancard.jpeg') }}" alt="Female">
                <p>FEMALE CHARACTER</p>
            </div>
        </div>

        <div id="workspace" class="workspace-layout" style="display: none;">
        
            <aside class="panel side-panel">
                <div class="panel-header"><h4>ATASAN</h4></div>
                <div id="list-atasan" class="item-list"></div>
            </aside>

        <main class="mannequin-frame">
            <div class="gender-switcher" onclick="switchGender()" title="Switch Gender">
                <img id="switch-icon" src="" alt="Alternative Character">
            </div>

            <div class="drop-area" id="drop-zone" 
                 ondragover="allowDrop(event)" 
                 ondragleave="clearHighlight()" 
                 ondrop="onDrop(event)">
                
                <img id="base-model" class="layer-base" src="">
                <img id="layer-bawahan" class="layer-item z-bawahan" src="" style="display:none;">
                <img id="layer-atasan" class="layer-item z-atasan" src="" style="display:none;">

                <div id="info-box" class="info-popup">
                    <strong id="p-name">Product Name</strong>
                    <hr>
                    <a href="#" class="btn-link">Lihat Katalog</a>
                </div>
            </div>
            
            <button class="btn-save" onclick="saveCombination()">❤️ Simpan Kombinasi</button>
        </main>

        <aside class="panel side-panel">
            <div class="panel-header"><h4>BAWAHAN</h4></div>
            <div id="list-bawahan" class="item-list"></div>
        </aside>

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
    <script src="{{asset ('js/page/mixmatch.js') }}"></script>
    @endpush