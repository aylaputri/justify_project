@extends('layouts.app')
@section('title', 'Pusat Bantuan')
@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/help.css') }}">
@endpush
@section('content')
<header class="header-help">
    <a href="{{ url('/profile') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Pusat Bantuan</h1>
</header>
<main class="help-body">
    <div class="help-intro">
        <h2>Ada yang bisa kami bantu?</h2>
        <p>Temukan jawaban atas pertanyaan yang sering ditanyakan di bawah ini.</p>
    </div>
    <div class="section-label">Pesanan</div>
    <div class="faq-card">
        <div class="faq-item">
            <div class="faq-question">
                <span>Bagaimana cara melacak pesanan saya?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Kamu bisa melacak pesanan melalui menu <strong>Pesanan Saya</strong> di halaman Profil. Pilih pesanan yang ingin dilacak, nomor resi akan tersedia setelah pesanan berstatus <strong>"Dikirim"</strong>. Gunakan nomor resi tersebut di website ekspedisi terkait.</div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>Apakah saya bisa membatalkan pesanan?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Pembatalan hanya bisa dilakukan saat status pesanan masih <strong>"Pending"</strong>. Jika pesanan sudah diproses, silakan hubungi tim kami melalui WhatsApp. Pesanan yang sudah dikirim tidak dapat dibatalkan.</div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>Berapa lama proses pengiriman?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Estimasi pengiriman tergantung ekspedisi yang dipilih. Umumnya 1–3 hari untuk Jawa, dan 3–7 hari untuk luar Jawa. Pesanan diproses dalam 1×24 jam setelah pembayaran dikonfirmasi.</div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>Apa yang harus dilakukan jika pesanan tidak sampai?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Jika pesanan tidak sampai melebihi estimasi, cek nomor resi di website ekspedisi terlebih dahulu. Jika tetap tidak ada informasi, hubungi kami via WhatsApp dengan menyertakan nomor pesanan kamu.</div>
            </div>
        </div>
    </div>
    <div class="section-label">Pembayaran</div>
    <div class="faq-card">
        <div class="faq-item">
            <div class="faq-question">
                <span>Metode pembayaran apa saja yang tersedia?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Kami menerima pembayaran melalui Transfer Bank (BCA, BNI, BRI, Mandiri, Permata), E-Wallet (GoPay, ShopeePay, DANA, OVO), minimarket (Alfamart/Indomaret), serta kartu kredit/debit Visa dan Mastercard.</div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>Berapa lama batas waktu pembayaran?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Batas waktu pembayaran adalah <strong>24 jam</strong> sejak pesanan dibuat. Jika melewati batas waktu, pesanan akan otomatis dibatalkan dan kamu perlu membuat pesanan baru.</div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>Apakah ada biaya tambahan saat checkout?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Harga yang tertera sudah termasuk semua biaya produk. Ongkos kirim dihitung terpisah berdasarkan ekspedisi dan tujuan pengiriman yang kamu pilih saat checkout.</div>
            </div>
        </div>
    </div>
    <div class="section-label">Produk & Retur</div>
    <div class="faq-card">
        <div class="faq-item">
            <div class="faq-question">
                <span>Apakah produk bisa dikembalikan atau ditukar?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Pengembalian/penukaran produk dapat dilakukan dalam <strong>3×24 jam</strong> setelah produk diterima, dengan syarat produk masih dalam kondisi original (belum dipakai, tag masih ada). Hubungi kami via WhatsApp untuk proses retur.</div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>Bagaimana jika produk yang diterima cacat atau salah?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Segera hubungi kami dengan foto bukti produk cacat/salah dalam <strong>1×24 jam</strong> setelah diterima. Kami akan mengganti produk tanpa biaya tambahan apapun, termasuk ongkos kirim retur.</div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>Bagaimana cara memilih ukuran yang tepat?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Setiap produk memiliki size chart yang tersedia di halaman detail produk. Ukur lingkar dada, pinggang, dan panjang badan kamu, lalu cocokkan dengan tabel ukuran yang tersedia. Jika ragu, pilih ukuran yang lebih besar.</div>
            </div>
        </div>
    </div>
    <div class="section-label">Akun</div>
    <div class="faq-card">
        <div class="faq-item">
            <div class="faq-question">
                <span>Bagaimana cara mengubah data profil?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Buka halaman <strong>Profil → Edit Profil</strong>. Kamu bisa mengubah nama, email, nomor HP, foto profil, dan password di sana. Jangan lupa klik tombol <strong>"Simpan Perubahan"</strong> setelah selesai.</div>
            </div>
        </div>
        <div class="faq-item">
            <div class="faq-question">
                <span>Saya lupa password, bagaimana cara resetnya?</span>
                <svg class="faq-chevron" fill="none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/></svg>
            </div>
            <div class="faq-answer">
                <div class="faq-answer-inner">Di halaman login, klik <strong>"Lupa Password"</strong>. Masukkan email yang terdaftar, dan link reset password akan dikirimkan ke email kamu. Link berlaku selama 60 menit.</div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('scripts')
<script src="{{ asset('js/page/help.js') }}"></script>
@endpush