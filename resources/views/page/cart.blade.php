@extends('layouts.app')
@section('title', 'Cart')

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/cart.css') }}">
@endpush

@section('content')

@include('components.navbar')

<main class="cart-page">
    <section class="cart-items" id="cartItems">
        @forelse($items as $item)
        @php
            $variant = $item->variant;
            $product = $variant?->product;
            $image   = $variant?->images?->first()?->image_url;
        @endphp
        <div class="cart-card"
             data-id="{{ $item->id_cart }}"
             data-variant="{{ $variant?->id_variant }}"
             data-price="{{ $variant?->price }}"
             data-stock="{{ $variant?->stock }}">
            <input type="checkbox" class="cart-check">
            <div class="cart-image">
                @if($image)
                <img src="{{ asset($image) }}" alt="{{ $product?->product_name }}">
                @else
                <div style="width:70px;height:70px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:24px;">👕</div>
                @endif
            </div>
            <div class="cart-info">
                <h3>{{ $product?->product_name }}</h3>
                <p>Rp {{ number_format($variant?->price, 0, ',', '.') }}</p>
                <small>Size: {{ $variant?->size }} | Color: {{ $variant?->color }}</small>
                <div class="cart-action">
                    <div class="qty-box">
                        <button class="minus-btn">-</button>
                        <span class="qty">{{ $item->quantity }}</span>
                        <button class="plus-btn">+</button>
                    </div>
                    <button class="delete-btn">
                        <img src="/assets/icon/trash.svg" alt="Delete">
                    </button>
                </div>
            </div>
        </div>
        @empty
        <p id="emptyCart">Keranjang masih kosong</p>
        @endforelse
    </section>

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
            <button class="checkout-btn" id="checkoutBtn">Check Out</button>
        </div>
    </aside>
</main>

@endsection

@push('scripts')
<script>
window.CART_CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>
<script src="{{ asset('js/page/cart.js') }}"></script>
@endpush