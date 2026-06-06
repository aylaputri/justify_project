@extends('layouts.app')
@section('title', 'Pesanan Saya')

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Poppins', sans-serif; background: #f5f5f5; }

.header-orders {
    display: flex;
    align-items: center;
    background: #1a1a1a;
    color: #fff;
    padding: 16px 20px;
    gap: 16px;
    position: sticky;
    top: 0;
    z-index: 100;
}
.header-orders h1 { font-size: 18px; font-weight: 600; }
.back-btn img { width: 24px; filter: invert(1); }

/* STATUS TABS */
.status-tabs {
    display: flex;
    overflow-x: auto;
    background: #fff;
    border-bottom: 1px solid #eee;
    scrollbar-width: none;
}
.status-tabs::-webkit-scrollbar { display: none; }
.tab-item {
    flex-shrink: 0;
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 500;
    color: #888;
    cursor: pointer;
    border-bottom: 2px solid transparent;
    white-space: nowrap;
}
.tab-item.active { color: #1a1a1a; border-bottom-color: #1a1a1a; font-weight: 600; }

/* ORDER CARDS */
.orders-body { padding: 12px 16px; display: flex; flex-direction: column; gap: 12px; padding-bottom: 40px; }

.order-card {
    background: #fff;
    border-radius: 14px;
    padding: 16px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}
.order-id { font-size: 12px; color: #888; }
.order-status {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
}
.status-Pending    { background: #fff3cd; color: #856404; }
.status-Diproses   { background: #cce5ff; color: #004085; }
.status-Dikirim    { background: #d4edda; color: #155724; }
.status-Selesai    { background: #d1ecf1; color: #0c5460; }
.status-Dibatalkan { background: #f8d7da; color: #721c24; }
.status-Refund     { background: #e2e3e5; color: #383d41; }

.order-items { display: flex; flex-direction: column; gap: 10px; margin-bottom: 14px; }
.order-item-row { display: flex; gap: 12px; align-items: center; }
.item-thumb {
    width: 56px; height: 56px;
    border-radius: 10px;
    background: #f0f0f0;
    object-fit: cover;
    flex-shrink: 0;
}
.item-thumb-placeholder {
    width: 56px; height: 56px;
    border-radius: 10px;
    background: #f0f0f0;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
}
.item-info { flex: 1; }
.item-name { font-size: 13px; font-weight: 600; color: #1a1a1a; }
.item-variant { font-size: 11px; color: #888; margin-top: 2px; }
.item-qty { font-size: 12px; color: #555; margin-top: 4px; }
.item-price { font-size: 13px; font-weight: 600; color: #1a1a1a; white-space: nowrap; }

.order-footer {
    border-top: 1px solid #f0f0f0;
    padding-top: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.footer-shipping { font-size: 11px; color: #888; }
.footer-shipping span { color: #555; font-weight: 500; }
.footer-total { text-align: right; }
.footer-total-label { font-size: 11px; color: #888; }
.footer-total-amount { font-size: 15px; font-weight: 700; color: #1a1a1a; }

.footer-tracking {
    margin-top: 8px;
    font-size: 11px;
    color: #555;
}
.footer-tracking span { font-weight: 600; color: #1a1a1a; }

.empty-orders {
    text-align: center;
    padding: 60px 20px;
    color: #888;
    font-size: 14px;
}
.empty-icon { font-size: 48px; margin-bottom: 12px; }
</style>
@endpush

@section('content')

<header class="header-orders">
    <a href="{{ url('/profile') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Pesanan Saya</h1>
</header>

<!-- STATUS TABS -->
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
                @endphp
                @if($img)
                <img class="item-thumb" src="{{ asset('storage/' . $img) }}" alt="">
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
            <div style="font-size:12px; color:#888; text-align:center;">+{{ $order->items->count() - 3 }} produk lainnya</div>
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

@endsection