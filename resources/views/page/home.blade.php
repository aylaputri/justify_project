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
                <img src="{{ asset('image/Foto/Gambar-kolase-cewe.jpg') }}?v={{ time() }}" alt="Hero Image">

                <div class="hero-text">
                    <h1>{!! nl2br(e(session('hero_headline', "MIX YOUR STYLE \n YOUR WAY"))) !!}</h1>
                </div>

                <button class="hero-button">
                    <a href="{{ session('hero_button_link', '/mixmatch') }}">Start Mix & Match ></a>
                </button>
            </section>

            <!-- ABOUT -->
            <section class="about">
                <h2>ABOUT SAVIOR WORLD</h2>

                <div class="card">
                    <h3>VISI</h3>
                    <ul>
                        @php
                            $visiDefault = "Drop fit yang relate sama lifestyle Gen Z\nBikin styling jadi fun lewat mix & match\nStay ahead tapi gak kehilangan identitas\nSupport self-expression tanpa batas";
                            $visiArray = explode("\n", session('visi_points', $visiDefault));
                        @endphp
            
                        @foreach($visiArray as $item)
                            @if(trim($item) !== "")
                                <li>{{ trim($item) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="card">
                    <h3>MISI</h3>
                    <ul>
                        @php
                           $misiDefault = "Drop fit yang relate sama lifestyle Gen Z\nBikin styling jadi fun lewat mix & match\nStay ahead tapi gak kehilangan identitas\nSupport self-expression tanpa batas";
                            $misiArray = explode("\n", session('misi_points', $misiDefault));
                        @endphp
            
                        @foreach($misiArray as $item)
                            @if(trim($item) !== "")
                                <li>{{ trim($item) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </section>  
            
            <!-- GALLERY -->
            <section class="gallery">
                <h2>OUR GALLERY</h2>
                <p>Swipe here</p>
                
                <div class="gallery-container">
                    @forelse ($galleryFiles as $fileName)
                        <img src="{{ asset('image/Foto/' . $fileName) }}" alt="Gallery Savior World">
                    @empty
                        <p style="color: #666; font-size: 14px; grid-column: 1/-1; text-align: center;"">Belum ada foto galeri.</p>
                    @endforelse
                </div>
            </section>
        </main>

<!-- FOOTER -->
@include('components.footer')
        
@endsection