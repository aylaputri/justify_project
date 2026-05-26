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

        <div class="checkout-box address-box" id="addressBox">

            <p>Add Address</p>

            <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="Arrow">

        </div>

    </section>

    <!-- ORDER SUMMARY -->
    <section class="checkout-section">

        <h2>Order Summary</h2>

        <div class="checkout-box" id="checkoutItems">

            <!-- AUTO DARI JS -->

        </div>

    </section>

    <!-- SHIPPING -->
    <section class="checkout-section">

        <h2>Shipping Method</h2>

        <div class="checkout-box shipping-box">

            <div class="shipping-info">

                <h3>Plus Delivery (1 to 3 days)</h3>

                <p>Est delivery: 20-23 Juni 2026</p>

            </div>

            <span class="shipping-price" id="shippingCost">
                Rp 0
            </span>

        </div>

    </section>

    <!-- TOTAL -->
    <section class="checkout-section">

        <h2>Total Payment</h2>

        <div class="checkout-box total-box">

            <div class="total-row">

                <span>Subtotal Product</span>

                <span id="subtotalProduct">
                    Rp 0
                </span>

            </div>

            <div class="total-row">

                <span>Shipping</span>

                <span id="shippingTotal">
                    Rp 0
                </span>

            </div>

            <div class="total-row">

                <strong>Total</strong>

                <strong id="totalProduct">
                    Rp 0
                </strong>

            </div>

        </div>

    </section>

</main>

<!-- BOTTOM PAYMENT -->
<div class="bottom-payment">

    <div class="bottom-left">

        <span>Total</span>

        <h2 id="finalTotal">
            Rp 0
        </h2>

        <p>
            This is the final step, after you touching
            Pay Now button, the payment will be transaction
        </p>

    </div>

    <button class="pay-btn" id="pay-button">

        Pay Now

    </button>

</div>

@endsection


@push('scripts')

<script src="{{ asset('js/page/checkout.js') }}"></script>

<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

@endpush