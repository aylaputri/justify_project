@extends('layouts.app')

@section('title', 'cart')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/cart.css') }}">

@endpush

@section('content')

<!-- HEADER -->
<header class="header-cart">

    <a href="{{ url('/katalog') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>

    <h1>Shopping Cart</h1>

</header>

<!-- MAIN -->
<main class="cart-page">

    <!-- CART ITEMS -->
    <section class="cart-items" id="cartItems">

        <!-- AUTO DARI JS -->

    </section>

    <!-- ORDER SUMMARY -->
    <aside class="summary-box">

        <h2>Order Summary</h2>

        <div class="summary-content">

            <div class="summary-row">

                <span>Selected Items</span>

                <span id="selectedItems">0</span>

            </div>

            <div class="summary-row">

                <span>Subtotal</span>

                <span id="subtotal">Rp 0</span>

            </div>

            <div class="summary-row">

                <span>Delivery</span>

                <span>Rp 15.000</span>

            </div>

        </div>

        <div class="summary-total">

            <div class="total-row">

                <h3>Total Amount</h3>

                <h3 id="totalAmount">Rp 0</h3>

            </div>

            <button class="checkout-btn" id="checkoutBtn">

                Check Out

            </button>

        </div>

    </aside>

</main>

@endsection

@push('scripts')
<script src="{{ asset('js/page/cart.js') }}"></script>
@endpush