@extends('layouts.app')

@section('title', 'mixmatch')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" />
<link rel="stylesheet" href="{{ asset('css/page/mixmatch.css') }}" >

@endpush

@section('content')

@include('components.navbar')

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
@include('components.footer')

@endsection

@push('scripts')
<script src="{{asset ('js/page/mixmatch.js') }}"></script>
@endpush