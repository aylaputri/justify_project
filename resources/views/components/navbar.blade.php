<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />

<header>
    <nav class="navbar">
        <div class="nav-container">

            <!-- LOGO -->
            <div class="logo">
                <img src="{{ asset('assets/image/Logo-Putih-Savior-World.png') }}">
            </div>

            <!-- MENU DESKTOP -->
            <div class="menu-desktop">
                <a href="{{ url('/home') }}"
                class="{{ request()->is('home') ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ url('/katalog') }}"
                class="{{ request()->is('katalog') ? 'active' : '' }}">
                    Catalog
                </a>

                <a href="{{ url('/mixmatch') }}"
                class="{{ request()->is('mixmatch') ? 'active' : '' }}">
                    Mix & Match
                </a>
            </div>

            <!-- ICON DESKTOP -->
            <div class="nav-icons">

                <a href="{{ url('/cart') }}">
                    <img src="{{ asset('assets/icon/cart.svg') }}" alt="Cart">
                </a>

                <a href="{{ url('/profile') }}">
                    <img src="{{ asset('assets/icon/profile.svg') }}" alt="Profile">
                </a>

            </div>

            <!-- HAMBURGER MOBILE -->
            <div class="hamburger" onclick="toggleMenu()">
                <img id="burger" src="{{ asset('assets/icon/icon-burger.svg') }}">
            </div>

        </div>
    </nav>

    <!-- OVERLAY MOBILE -->
    <div class="backdrop" id="backdrop" onclick="toggleMenu()"></div>

    <div class="overlay" id="overlay">

        <div class="close" onclick="toggleMenu()">
            <img src="{{ asset('assets/icon/icon-close-putih.svg') }}">
        </div>

        <div class="menu-overlay">

            <a href="{{ url('/home') }}">Home</a>

            <a href="{{ url('/katalog') }}">Catalog</a>

            <a href="{{ url('/mixmatch') }}">Mix & Match</a>

            <a href="{{ url('/cart') }}">Cart</a>

            <a href="{{ url('/profile') }}">Profile</a>

        </div>
    </div>
</header>