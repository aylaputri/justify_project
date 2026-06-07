@extends('layouts.app')
@section('title', 'Checkout')

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/checkout.css') }}">
@endpush

@section('content')

<header class="header-checkout">
    <a href="{{ url('/cart') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Checkout</h1>
</header>

<main>

    {{-- ADDRESS --}}
    <section class="checkout-section">
        <h2>Address</h2>
        <div class="checkout-box address-box" id="addressBox"
             onclick="window.location.href='/address?from=checkout'">
            @if($address)
            <div>
                <strong>{{ $address->address_title }}</strong>
                <p>
                    {{ $address->complete_address }}<br>
                    {{ $address->city }}, {{ $address->province }}<br>
                    {{ $address->postal_code }}
                </p>
            </div>
            @else
            <p>Tambah Alamat</p>
            @endif
            <img src="{{ asset('assets/icon/arrow-right.svg') }}" alt="Arrow">
        </div>
    </section>

    {{-- ORDER SUMMARY --}}
    <section class="checkout-section">
        <h2>Order Summary</h2>
        <div class="checkout-box" id="checkoutItems">
            @forelse($cartItems as $item)
            @php
                $variant = $item->variant;
                $product = $variant?->product;
                $image   = $variant?->images?->first()?->image_url;
            @endphp
            <div class="order-card" data-id="{{ $item->id_cart }}">
                <div class="order-image">
                    @if($image)
                    <img src="{{ asset($image) }}" alt="{{ $product?->product_name }}">
                    @else
                    <div style="width:60px;height:60px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:20px;">👕</div>
                    @endif
                </div>
                <div class="order-info">
                    <h3>{{ $product?->product_name }}</h3>
                    <p>Size: {{ $variant?->size }}<br>Color: {{ $variant?->color }}</p>
                    <div class="order-action">
                        <div class="qty-box">
                            <button class="minus-btn" data-id="{{ $item->id_cart }}" data-qty="{{ $item->quantity }}">-</button>
                            <span id="qty-{{ $item->id_cart }}">{{ $item->quantity }}</span>
                            <button class="plus-btn" data-id="{{ $item->id_cart }}" data-qty="{{ $item->quantity }}" data-stock="{{ $variant?->stock }}">+</button>
                        </div>
                        <button class="delete-btn" data-id="{{ $item->id_cart }}">
                            <img src="/assets/icon/trash.svg" alt="Delete">
                        </button>
                    </div>
                </div>
                <span class="item-price" id="price-{{ $item->id_cart }}"
                      data-unit="{{ $variant?->price }}">
                    Rp {{ number_format($variant?->price * $item->quantity, 0, ',', '.') }}
                </span>
            </div>
            @empty
            <p>Tidak ada produk</p>
            @endforelse
        </div>
    </section>

    {{-- SHIPPING --}}
    <section class="checkout-section">
        <h2>Shipping Method</h2>
        <div class="checkout-box shipping-box">
            <div class="shipping-info">
                <h3>Plus Delivery (1 to 3 days)</h3>
                <p>Est delivery: {{ now()->addDays(2)->format('d') }}-{{ now()->addDays(4)->format('d M Y') }}</p>
            </div>
            <span class="shipping-price" id="shippingCost">Rp 15.000</span>
        </div>
    </section>

    {{-- TOTAL --}}
    <section class="checkout-section">
        <h2>Total Payment</h2>
        <div class="checkout-box total-box">
            <div class="total-row">
                <span>Subtotal Product</span>
                <span id="subtotalProduct">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="total-row">
                <span>Shipping</span>
                <span id="shippingTotal">Rp 15.000</span>
            </div>
            <div class="total-row">
                <strong>Total</strong>
                <strong id="totalProduct">Rp {{ number_format($subtotal + 15000, 0, ',', '.') }}</strong>
            </div>
        </div>
    </section>

</main>

<div class="bottom-payment">
    <div class="bottom-left">
        <span>Total</span>
        <h2 id="finalTotal">Rp {{ number_format($subtotal + 15000, 0, ',', '.') }}</h2>
        <p>This is the final step, after you touching Pay Now button, the payment will be transaction</p>
    </div>
    <button class="pay-btn" id="pay-button"
        {{ !$address ? 'disabled' : '' }}
        style="{{ !$address ? 'opacity:0.5;cursor:not-allowed' : '' }}">
        {{ $address ? 'Pay Now' : 'Pilih Alamat Dulu' }}
    </button>
</div>

@endsection

@push('scripts')
<script>
window.CHECKOUT_CSRF     = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
window.HAS_ADDRESS       = {{ $address ? 'true' : 'false' }};
window.ADDRESS_ID        = {{ $address ? $address->id_address : 'null' }};
</script>
<script src="{{ asset('js/page/checkout.js') }}"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
@endpush