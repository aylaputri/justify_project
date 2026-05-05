<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Savior World</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
        

        <style>
            /* TAMPILAN MOBILE (DEFAULT) */
body{
    margin: 0;
    font-family: 'Poppins', sans-serif;
}

/* STYLE NAVBAR */
.navbar{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: black;
    padding: 12px 0;
    z-index: 1000;
}

.nav-container{
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

/* LOGO NAVBAR */
.logo{
    display: flex;
    align-items: center;
}

.logo img{
    height: 40px;
    display: block;
}

/* HAMBURGER NAVBAR */
.hamburger img{
    width: 24px;
    cursor: pointer;
    display: block;
}

/* MENU DESKTOP */
.menu-desktop{
    display: none; /* hidden di tampilan mobile */
}

.menu-desktop a{
    color: white;
    text-decoration: none;
    margin-left: 30px;
    font-weight: 500;
}

.menu-desktop a.active{
    font-weight: 700;
}

/* BACKDROP OVERLAY */
.backdrop{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.25);
    opacity: 0;
    visibility: hidden;
    z-index: 998;
}

.backdrop.active{
    opacity: 1;
    visibility: visible;
}

/* OVERLAY MENU MOBILE */
.overlay{
    position: fixed;
    top: -50%;
    width: 100%;
    background: black;
    z-index: 999;
    padding: 20px 0;
}

.overlay.active{
    top: 0;
}

.close{
    text-align: right;
    cursor: pointer;
}

.close img{
    width: 24px;
}

/* MENU OVERLAY */
.menu-overlay{
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 20px;
    gap: 20px;
}

.menu-overlay a{
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: 500;
}

main{
    margin-top: 80px;
}

/* STYLE FOOTER */
footer{
    background-color: black;
    color: white;
    padding: 20px 40px;
}

.footer-container{
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-between;
    gap: 20px;
}

.footer-section{
    flex: 0 1 auto;
}

.footer-title{
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 10px;
}

.brand-section img{
    width: 120px;
    margin-bottom: 10px;
}

.brand-section p{
    font-size: 14px;
    margin-top: 5px;
}

.social-section{
    text-align: right;
}

.social-icons{
    display: flex;
    gap: 15px;
    justify-content: flex-end;
}

.social-icons img{
    width: 30px;
    height: auto;
}

.contact-section{
    flex: 1 1 100%;
}

.contact-section p{
    font-size: 14px;
    margin: 5px 0;
}

.footer-bottom{
    margin-top: 20px;
    text-align: center;
    font-style: italic;
    font-size: 13px;
    border-top: 1px solid #333;
    padding-top: 20px;
    width: 100%;
}

/* TAMPILAN DESKTOP */
@media (min-width: 768px) {
    .menu-desktop{
        display: flex;
        align-items: center; 
    }

    .hamburger{
        display: none;
    }

    .backdrop{
        display: none;
    }

    .overlay{
        display: none;
    }

    .footer-container{
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        gap: 80px;
        align-items: flex-start;
    }

    .footer-title {
        font-size: 20px;
    }

    .footer-section{
        flex: 0 1 auto;
        text-align: left;
    }

    .social-section{
        text-align: left;
    }

    .social-icons{
        justify-content: flex-start;
    }

    .contact-section{
        flex: 0 1 auto;
    }

    .footer-bottom{
        text-align: center;
        margin-top: 40px;
    }
}
        </style>

        <style>
            /* Hero Section */
.hero{
    position: relative;
    width: 100%;
    margin-top: -80px;
    padding-top: 62px;
    z-index: 2;
}

.hero img{
    display: block;
    width: 100%;
    height: auto;
    object-fit: cover;
}

.hero::after{
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
}

.hero-text{
    position: absolute;
    top: 60%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    width: 90%;
    z-index: 2;
}

.hero-text h1{
    color: white;
    font-size: 26px;
    font-weight: 700;
    line-height: 1;
}

.hero-button{
    position: absolute;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    border-radius: 8px;
    border: none;
    background: white;
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
    z-index: 3;
    cursor: pointer;
}

.hero-button a{
    color: black;
    text-decoration: none;
    font-family: Poppins;
}

/* About Section */
.about{
    margin-top: 80px;
    padding: 0px 20px;
    text-align: center;
}

.about h2{
    font-size: 18px;
    margin-bottom: 20px;
}

/* Info Cards (Visi & Misi) */
.card{
    border: 1px solid #ccc;
    border-radius: 12px;
    padding: 14px 16px;
    margin-bottom: 20px;
    text-align: left;
}

.card h3{
    margin-bottom: 10px;
    text-align: center;
}

.card ul{
    padding-left: 16px; 
    font-size: 13px;
}

/* Gallery Section */
.gallery{
    margin: 40px 0;
    padding: 0 20px; 
    text-align: center;
}

.gallery h2{
    font-size: 18px;
}

.gallery p{
    font-size: 12px;
    margin-bottom: 16px;
}

/* Container untuk Scroll */
.gallery-container{
    display: flex;
    gap: 20px;
    overflow-x: auto; 
    justify-content: flex-start;
}

/* Menghilangkan scrollbar di Chrome, Safari, dan Edge */
.gallery-container::-webkit-scrollbar {
    display: none;
}

.gallery-container img{
    width: 120px; 
    border-radius: 12px;
}

@media (min-width: 768px) {
    .hero{
        margin: -80px auto 0;
    }

    .hero img{
        height: 500px;
        object-fit: cover;
    }
    .hero-text h1{
        font-size: 52px;
    }

    .hero-button{
        font-size: 16px;
        padding: 12px 24px;
    }

    .about{
        max-width: 900px;
        margin: 100px auto;
    }

    .about h2{
        font-size: 28px;
    }

    .card{
        padding: 20px;
    }

    .card h3{
        font-size: 20px;
    }

    .card ul{
        font-size: 15px;
    }

    .gallery{
        max-width: 1000px;
        margin: 80px auto;
    }

    .gallery h2{
        font-size: 28px;
    }

    .gallery p{
        display: none;
    }

    .gallery-container{
        justify-content: center;
    }

    .gallery-container img{
        width: 200px;
    }
}
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar">
                <div class="nav-container">
                    <div class="logo">
                        <img src="image/Logo-Putih-Savior-World.png" alt="Savior World Logo White">
                    </div>

                    <!-- MENU MOBILE -->
                    <div class="hamburger" onclick="toggleMenu()">
                        <img id="burger" src="image/icon/icon-burger.svg" alt="Open Menu">
                    </div>

                    <!-- MENU DESKTOP -->
                    <div class="menu-desktop">
                        <a href="index.html">Home</a>
                        <a href="html/catalog.html">Catalog</a>
                        <a href="html/mixmatch.html">Mix & Match</a>
                    </div>
                </div>
            </nav>

            <!-- OVERLAY MENU MOBILE -->
            <div class="backdrop" id="backdrop" onclick="toggleMenu()"></div> <!-- Biar background gelap saat buka overlay -->
            <div class="overlay" id="overlay">
                <div class="close" onclick="toggleMenu()">
                    <img src="image/icon/icon-close-putih.svg" alt="Close Menu">
                </div>

                <div class="menu-overlay">
                    <a href="index.html">Home</a>
                    <a href="html/catalog.html">Catalog</a>
                    <a href="html/mixmatch.html">Mix & Match</a>
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

        <script src="script.js"></script>
    </body>
</html>
