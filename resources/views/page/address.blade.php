@extends('layouts.app')

@section('title', 'Alamat Pengiriman')

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/address.css') }}">
@endpush
@section('content')
@php
    $fromCheckout = request()->query('from') === 'checkout';
@endphp
<header class="header-address">
    <a href="{{ $fromCheckout ? url('/checkout') : url('/profile') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Alamat Pengiriman</h1>
</header>
<main class="address-body-wrap">
    <div class="address-list" id="addressList">
        @forelse($addresses as $addr)
        <div class="address-card"
             id="card-{{ $addr->id_address }}"
             data-id="{{ $addr->id_address }}"
             data-title="{{ $addr->address_title }}"
             data-address="{{ $addr->complete_address }}"
             data-city="{{ $addr->city }}"
             data-province="{{ $addr->province }}"
             data-postal="{{ $addr->postal_code }}">
            <div class="addr-header">
                <div class="addr-title">{{ $addr->address_title }}</div>
                <div class="addr-actions">
                    <button class="btn-edit" data-id="{{ $addr->id_address }}">Edit</button>
                    <button class="btn-delete" data-id="{{ $addr->id_address }}">Hapus</button>
                </div>
            </div>
            <div class="addr-detail">
                {{ $addr->complete_address }}, {{ $addr->city }}, {{ $addr->province }}.
            </div>
        </div>
        @empty
        <p class="empty-text" id="emptyText">Belum ada alamat tersimpan</p>
        @endforelse
    </div>

    <a href="{{ url('/addAddress') . ($fromCheckout ? '?from=checkout' : '') }}" class="add-address-btn">
        + Tambah Alamat
    </a>

    <div class="bottom-apply" id="applyBar" style="{{ $fromCheckout ? '' : 'display:none' }}">
        <button class="apply-btn" id="btnApplyAddress">Pilih Alamat</button>
    </div>
</main>

{{-- Modal Edit --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-sheet">
        <h2>Edit Alamat</h2>
        <input type="hidden" id="editId">
        <div class="modal-field">
            <label for="editTitle">Judul Alamat</label>
            <input type="text" id="editTitle" placeholder="Rumah / Kantor">
        </div>
        <div class="modal-field">
            <label for="editAddress">Alamat Lengkap</label>
            <input type="text" id="editAddress" placeholder="Jalan, nomor, dll">
        </div>
        <div class="modal-field">
            <label for="editCity">Kota</label>
            <input type="text" id="editCity" placeholder="Kota">
        </div>
        <div class="modal-field">
            <label for="editProvince">Provinsi</label>
            <input type="text" id="editProvince" placeholder="Provinsi">
        </div>
        <div class="modal-field">
            <label for="editPostal">Kode Pos</label>
            <input type="text" id="editPostal" placeholder="Kode pos">
        </div>
        <div class="modal-actions">
            <button class="modal-cancel" id="btnCancelEdit">Batal</button>
            <button class="modal-save" id="btnSaveEdit">Simpan</button>
        </div>
    </div>
</div>

{{-- Confirm Delete --}}
<div class="confirm-overlay" id="deleteConfirm">
    <div class="confirm-box">
        <h3>Hapus Alamat</h3>
        <p>Yakin ingin menghapus alamat ini? Tindakan ini tidak bisa dibatalkan.</p>
        <div class="confirm-actions">
            <button class="confirm-no" id="btnCancelDelete">Batal</button>
            <button class="confirm-yes" id="btnConfirmDelete">Hapus</button>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    window.AddressConfig = {
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        sessionName: @json(session('user_name')),
        fromCheckout: {{ $fromCheckout ? 'true' : 'false' }}
    };
</script>
<script src="{{ asset('js/page/address.js') }}"></script>
@endpush