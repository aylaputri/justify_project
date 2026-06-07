@extends('layouts.app')
@section('title', 'addAddress')
@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/addAddress.css') }}">
@endpush

@section('content')
@php
    $fromCheckout = request()->query('from') === 'checkout';
@endphp

<header class="header-addAddress">
    <a href="{{ $fromCheckout ? url('/address?from=checkout') : url('/address') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Add Address</h1>
</header>

<main>
    <section class="form-section">
        <h2>Recipients Information</h2>
        <p class="required-text">*Required fields.</p>

        <form id="addAddressForm" class="checkout-form">
            @csrf
            <input type="hidden" name="from" value="{{ $fromCheckout ? 'checkout' : '' }}">

            <div class="field-group">
                <label>Name</label>
                <div class="input-group">
                    <input type="text" name="recipient_name" placeholder="Enter your name" required>
                </div>
            </div>

            <div class="field-group">
                <label>Phone Number</label>
                <div class="phone-wrapper">
                    <div class="country-code">
                        <div class="flag-id">
                            <img src="{{ asset('assets/icon/indonesia flag.svg') }}" alt="flag">
                        </div>
                        <span>+62</span>
                    </div>
                    <input type="number" name="phone" placeholder="812xxxxxxxx" required>
                </div>
            </div>

            <div class="field-group">
                <label>Email</label>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Enter your email">
                </div>
            </div>

            <p class="info-text">This address will be used to send your order and billing details.</p>

            <h2 class="shipping-title">Shipping Address</h2>

            <div class="field-group">
                <label>Address Title</label>
                <div class="input-group">
                    <input type="text" name="address_title" placeholder="Home / Office" required>
                </div>
            </div>

            <div class="field-group">
                <label>Address</label>
                <div class="input-group">
                    <input type="text" name="complete_address" placeholder="Street, apartment, etc" required>
                </div>
            </div>

            <div class="field-group">
                <label>City</label>
                <div class="input-group">
                    <input type="text" name="city" placeholder="Enter city" required>
                </div>
            </div>

            <div class="field-group">
                <label>Province</label>
                <div class="input-group">
                    <input type="text" name="province" placeholder="Enter province" required>
                </div>
            </div>

            <div class="field-group">
                <label>Postal Code</label>
                <div class="input-group">
                    <input type="text" name="postal_code" placeholder="Enter postal code" required>
                </div>
            </div>
        </form>
    </section>
</main>

<div class="bottom-action">
    <a href="{{ $fromCheckout ? url('/address?from=checkout') : url('/address') }}" class="cancel-btn">
        Cancel
    </a>
    <button class="save-btn" id="saveBtn" disabled>
        Save
    </button>
</div>

@endsection

@push('scripts')
<script>
    window.AddAddressConfig = {
        csrfToken: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        fromCheckout: {{ $fromCheckout ? 'true' : 'false' }},
        storeUrl: '{{ url("/addAddress") }}'
    };
</script>
<script src="{{ asset('js/page/addAddress.js') }}"></script>
@endpush