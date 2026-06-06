@extends('layouts.app')
@section('title', 'Address')

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Poppins', sans-serif; background: #fff; }

.header-address {
    display: flex;
    align-items: center;
    background: #1a1a1a;
    color: #fff;
    padding: 16px 20px;
    gap: 16px;
}
.header-address h1 { font-size: 18px; font-weight: 600; }
.back-btn img { width: 24px; filter: invert(1); }

.address-list {
    padding: 20px 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding-bottom: 100px;
}

.address-card {
    background: #f5f5f5;
    border-radius: 12px;
    padding: 16px;
    cursor: pointer;
    border: 2px solid transparent;
    transition: border 0.2s;
}
.address-card.selected { border-color: #1a1a1a; }
.address-card .addr-title {
    font-size: 12px;
    color: #888;
    margin-bottom: 6px;
    font-weight: 500;
}
.address-card .addr-detail {
    font-size: 14px;
    color: #1a1a1a;
    line-height: 1.6;
}

.add-address-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin: 0 16px;
    border: 2px dashed #ccc;
    border-radius: 12px;
    padding: 16px;
    font-size: 14px;
    font-weight: 600;
    color: #1a1a1a;
    background: transparent;
    cursor: pointer;
    text-decoration: none;
}
.add-address-btn:hover { border-color: #1a1a1a; }

.bottom-apply {
    position: fixed;
    bottom: 0; left: 0; right: 0;
    padding: 16px;
    background: #fff;
    border-top: 1px solid #eee;
}
.apply-btn {
    width: 100%;
    padding: 16px;
    background: #1a1a1a;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
}
.empty-text {
    text-align: center;
    color: #888;
    padding: 40px 20px;
    font-size: 14px;
}
</style>
@endpush

@section('content')

<header class="header-address">
    <a href="{{ url('/checkout') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Address</h1>
</header>

<div class="address-list" id="addressList">
    @forelse($addresses as $addr)
    <div class="address-card"
         data-title="{{ $addr->address_title }}"
         data-address="{{ $addr->complete_address }}"
         data-city="{{ $addr->city }}"
         data-province="{{ $addr->province }}"
         data-postal="{{ $addr->postal_code }}"
         onclick="selectAddress(this)">
        <div class="addr-title">{{ $addr->address_title }}</div>
        <div class="addr-detail">
            {{ $addr->complete_address }}, {{ $addr->city }}, {{ $addr->province }}.
        </div>
    </div>
    @empty
    <p class="empty-text">Belum ada alamat tersimpan</p>
    @endforelse
</div>

<a href="{{ url('/addAddress') }}" class="add-address-btn">+ Add Address</a>

<div class="bottom-apply">
    <button class="apply-btn" onclick="applyAddress()">Apply</button>
</div>

@endsection

@push('scripts')
<script>
let selectedData = null;

// Highlight kalau sudah ada address tersimpan di localStorage
const saved = JSON.parse(localStorage.getItem('address'));
if (saved) {
    document.querySelectorAll('.address-card').forEach(card => {
        if (card.dataset.address === saved.address && card.dataset.city === saved.city) {
            card.classList.add('selected');
            selectedData = saved;
        }
    });
}

function selectAddress(el) {
    document.querySelectorAll('.address-card').forEach(c => c.classList.remove('selected'));
    el.classList.add('selected');
    selectedData = {
        title:    el.dataset.title,
        address:  el.dataset.address,
        city:     el.dataset.city,
        province: el.dataset.province,
        postal:   el.dataset.postal,
        name:     '{{ session("user_name") }}',
        phone:    '',
    };
}

function applyAddress() {
    if (!selectedData) {
        alert('Pilih alamat terlebih dahulu!');
        return;
    }
    localStorage.setItem('address', JSON.stringify(selectedData));
    window.location.href = '/checkout';
}
</script>
@endpush