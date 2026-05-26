@extends('layouts.app')

@section('title', 'addAddress')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/addAddress.css') }}">

@endpush

@section('content')

<!-- HEADER -->
<header class="header-addAddress">

    <a href="{{ url('/checkout') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>

    <h1>Add Address</h1>

</header>

<!-- MAIN -->
<main>

    <section class="form-section">

        <h2>Recipients Information</h2>

        <p class="required-text">
            *Required fields.
        </p>

        <form class="checkout-form">

            <!-- NAME -->
            <div class="field-group">

                <label>Name</label>

                <div class="input-group">
                    <input type="text" placeholder="Enter your name"  required>
                </div>

            </div>

            <!-- PHONE -->
            <div class="field-group">

                <label>Phone Number</label>

                <div class="phone-wrapper">

                    <div class="country-code">

                        <div class="flag-id">
                            <img src="{{ asset('assets/icon/indonesia flag.svg') }}" alt="flag">
                        </div>

                        <span>+62</span>

                    </div>

                    <input type="number" placeholder="812xxxxxxxx"  required>

                </div>

            </div>

            <!-- EMAIL -->
            <div class="field-group">

                <label>Email</label>

                <div class="input-group">
                    <input type="email" placeholder="Enter your email">
                </div>

            </div>

            <p class="info-text">
                This address will be used to send your order and billing details.
            </p>

            <!-- SHIPPING -->
            <h2 class="shipping-title">
                Shipping Address
            </h2>

            <!-- ADDRESS TITLE -->
            <div class="field-group">

                <label>Address Title</label>

                <div class="input-group">
                    <input type="text" placeholder="Home / Office">
                </div>

            </div>

            <!-- ADDRESS -->
            <div class="field-group">

                <label>Address</label>

                <div class="input-group">
                    <input type="text" placeholder="Street, apartment, etc"  required>
                </div>

            </div>

            <!-- CITY -->
            <div class="field-group">

                <label>City</label>

                <div class="input-group">
                    <input type="text" placeholder="Enter city"  required>
                </div>

            </div>

            <!-- PROVINCE -->
            <div class="field-group">

                <label>Province</label>

                <div class="input-group">
                    <input type="text" placeholder="Enter province"  required>
                </div>

            </div>

            <!-- POSTAL -->
            <div class="field-group">

                <label>Postal Code</label>

                <div class="input-group">
                    <input type="text" placeholder="Enter postal code"  required>
                </div>

            </div>

        </form>

    </section>

</main>

<!-- BOTTOM ACTION -->
<div class="bottom-action">

    <button class="cancel-btn">
        Cancel
    </button>

    <button class="save-btn" disabled>
        Save
    </button>
<script src="{{ asset('js/page/addAddress.js') }}"></script>
</div>

@endsection