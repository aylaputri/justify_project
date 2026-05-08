@extends('layouts.app')

@section('title', 'home')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
<link rel="stylesheet" href="{{ asset('css/page/home.css') }}" >

@endpush

@section('content')

@include('components.navbar')

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
@include('components.footer')
        
@endsection
