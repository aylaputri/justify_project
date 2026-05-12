@extends('layouts.app')

@section('title', 'checkout')

@push('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/checkout.css') }}">

@endpush

@section('content')

<!-- HEADER -->
<header class="header-checkout">

    <a href="{{ url('/cart') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>

    <h1>Checkout</h1>

</header>

<main>

    <!-- ADDRESS -->
    <section class="checkout-section">

        <h2>Address</h2>

        <a href="{{ url('/addAddress') }}">
            <div class="checkout-box address-box">

                <p>Add Address</p>

                <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="Arrow">

            </div>
        </a>

    </section>

    <!-- PAYMENT -->
    <section class="checkout-section">

        <h2>Payment</h2>

        <div class="checkout-box payment-box">

            <img src="{{ asset('assets/icon/qris.svg') }}" alt="Qris">

            <span>Qris</span>

        </div>

    </section>

    <!-- ORDER SUMMARY -->
    <section class="checkout-section">

        <h2>Order Summary</h2>

        <div class="checkout-box">

            <div class="order-card">

                <!-- IMAGE -->
                <div class="order-image">

                    <img src="{{ asset('image/baju.jpg') }}" alt="Product">

                </div>

                <!-- INFO -->
                <div class="order-info">

                    <h3>Nama Produk</h3>

                    <p>Size, Warna</p>

                    <div class="order-action">

                        <!-- QTY -->
                        <div class="qty-box">

                            <button>-</button>

                            <span>1</span>

                            <button>+</button>

                        </div>

                        <!-- DELETE -->
                        <button class="delete-btn">

                            <img src="{{ asset('assets/icon/trash.svg') }}" alt="Delete">

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- SHIPPING -->
    <section class="checkout-section">

        <h2>Shipping Methode</h2>

        <div class="checkout-box shipping-box">

            <div class="shipping-info">

                <h3>Plus Delivery (1 to 3 days)</h3>

                <p>Est delivery: 20-23 Juni 2026</p>

            </div>

            <span class="shipping-price">Rp 30.000</span>

        </div>

    </section>

    <!-- TOTAL -->
    <section class="checkout-section">

        <h2>Total Payment</h2>

        <div class="checkout-box total-box">

            <div class="total-row">

                <span>Total</span>

                <span>Harga</span>

            </div>

            <div class="total-row">

                <span>Subtotal Product</span>

                <span>Harga</span>

            </div>

            <div class="total-row">

                <span>Shipping</span>

                <span>Rp 30.000</span>

            </div>

        </div>

    </section>

</main>

<!-- BOTTOM PAYMENT -->
<div class="bottom-payment">

    <div class="bottom-left">

        <span>Total</span>

        <h2>Rp</h2>

        <p>
            This is the final step, after you touching
            Pay Now button, the payment will be transaction
        </p>

    </div>

    <button class="pay-btn">

        Pay Now

    </button>

</div>