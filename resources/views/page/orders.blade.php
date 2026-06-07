@extends('layouts.app')
@section('title', 'Pesanan Saya')
@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/orders.css') }}">
@endpush
@section('content')
<header class="header-orders">
    <a href="{{ url('/profile') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Pesanan Saya</h1>
</header>
<main>
    @php
        $tabs = ['Semua', 'Pending', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan', 'Refund'];
        $activeStatus = request('status', 'Semua');
    @endphp
    <div class="status-tabs">
        @foreach($tabs as $tab)
        <a href="{{ url('/orders') }}?status={{ $tab }}" class="tab-item {{ $activeStatus === $tab ? 'active' : '' }}">
            {{ $tab }}
        </a>
        @endforeach
    </div>
    <div class="orders-body">
        @forelse($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <span class="order-id">#{{ str_pad($order->id_order, 6, '0', STR_PAD_LEFT) }} · {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</span>
                <span class="order-status status-{{ $order->status }}">{{ $order->status }}</span>
            </div>
            <div class="order-items">
                @foreach($order->items->take(3) as $item)
                <div class="order-item-row">
                    @php
                        $img = $item->variant?->images?->first()?->image_url ?? null;
                        // Handle dua format: 
                        // - lama: "assets/image/..." → pakai asset() langsung
                        // - baru dari upload admin: "products/..." → pakai asset('storage/...')
                        if ($img) {
                            $imgSrc = str_starts_with($img, 'assets/') || str_starts_with($img, 'image/')
                                ? asset($img)
                                : asset('storage/' . $img);
                        }
                    @endphp
                    @if($img)
                    <img class="item-thumb" src="{{ $imgSrc }}" alt="">
                    @else
                    <div class="item-thumb-placeholder">👕</div>
                    @endif
                    <div class="item-info">
                        <div class="item-name">{{ $item->variant?->product?->product_name ?? 'Produk' }}</div>
                        <div class="item-variant">{{ $item->variant?->size ?? '-' }} / {{ $item->variant?->color ?? '-' }}</div>
                        <div class="item-qty">x{{ $item->quantity }}</div>
                    </div>
                    <div class="item-price">Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</div>
                </div>
                @endforeach

                @if($order->items->count() > 3)
                <div class="more-items-text">+{{ $order->items->count() - 3 }} produk lainnya</div>
                @endif
            </div>
            <div class="order-footer">
                <div class="footer-shipping">
                    Pengiriman: <span>{{ $order->shipping_method ?? '-' }}</span><br>
                    Pembayaran: <span>{{ $order->payment_method ?? '-' }}</span>
                    @if($order->tracking_number)
                    <div class="footer-tracking">Resi: <span>{{ $order->tracking_number }}</span></div>
                    @endif
                </div>
                <div class="footer-total">
                    <div class="footer-total-label">Total</div>
                    <div class="footer-total-amount">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-orders">
            <div class="empty-icon">📦</div>
            <div>Belum ada pesanan {{ $activeStatus !== 'Semua' ? '"' . $activeStatus . '"' : '' }}</div>
        </div>
        @endforelse
    </div>
</main>
@endsection
@push('scripts')
<script src="{{ asset('js/page/orders.js') }}"></script>
@endpush