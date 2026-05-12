@extends('layouts.app')

@section('title', 'addAddress')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/addAddress.css') }}">

@endpush

@section('content')

<!-- HEADER -->
<header class="header-addAddress">

    <a href="{{ url('/cart') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>

    <h1>Add Address</h1>

</header>


<main class="addAddress-page">

    <!-- RECIPIENT -->
    <section class="form-section">

        <h2>Recipents Information</h2>

        <p class="required-text">
            *Required fields.
        </p>

        <form class="checkout-form">

            <!-- NAME -->
            <div class="input-group">
                <input type="text" placeholder="Name*">
            </div>

            <!-- PHONE -->
            <div class="phone-wrapper">

                <div class="country-code">

                    <div class="flag-id">
                        <div class="red"></div>
                        <div class="white"></div>
                    </div>

                    <span>+62</span>

                </div>

                <input type="text" placeholder="Phone Number*">

            </div>

            <!-- EMAIL -->
            <div class="input-group">
                <input type="email" placeholder="Email*">
            </div>

            <p class="info-text">
                This address will be used to send you order and bill details.
            </p>

            <!-- SHIPPING -->
            <h2 class="shipping-title">
                Shipping Address
            </h2>

            <div class="input-group">
                <input type="text" placeholder="Address Tittle (Optional)">
            </div>

            <div class="input-group textarea-group">

                <input type="text" placeholder="Address*">

            </div>

            <div class="input-group">
                <input type="text" placeholder="City*">
            </div>

            <div class="input-group">
                <input type="text" placeholder="Province*">
            </div>

            <div class="input-group">
                <input type="text" placeholder="postal code">
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

</div>

@endsection