@extends('layouts.app')
@section('title', 'Invoice #' . $order->id_order)
@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('css/page/invoice.css') }}">
@endpush
@section('content')
<header class="header-invoice">
    <a href="{{ url('/orders') }}" class="back-btn">
        <img src="{{ asset('assets/icon/back.svg') }}" alt="Back">
    </a>
    <h1>Invoice</h1>
</header>
<main class="invoice-wrap">
    {{-- INVOICE CARD CONTAINER --}}
    <div class="invoice-container">

        {{-- CARD HEADER BRAND --}}
        <div class="invoice-header-brand">
            <div>
                <div class="brand-name">Savior World</div>
                <div class="brand-sub">Official Store</div>
            </div>
            <div class="invoice-meta">
                <h2>Invoice</h2>
                <div class="order-id">#{{ $order->id_order }}</div>
                <div class="order-date">
                    {{ \Carbon\Carbon::parse($order->order_date)->format('d F Y') }}
                </div>
            </div>
        </div>

        {{-- STATUS BANNER --}}
        <div class="status-banner">
            <span>Status Pesanan:</span>
            <span class="status-badge-inv status-{{ strtolower(str_replace(' ', '-', $order->status)) }}">
                {{ $order->status }}
            </span>
            @if($order->tracking_number)
                &nbsp;·&nbsp;
                <span>Resi: <strong>{{ $order->tracking_number }}</strong></span>
            @endif
        </div>

        {{-- BODY --}}
        <div class="invoice-body">
            <div class="info-grid">
                <div class="info-block">
                    <h4>Pembeli</h4>
                    <strong>{{ $order->user?->full_name ?? '-' }}</strong>
                    <p>{{ $order->user?->email ?? '-' }}</p>
                </div>
                <div class="info-block">
                    <h4>Alamat Pengiriman</h4>
                    <p>{{ $order->shipping_address }}</p>
                </div>
                <div class="info-block">
                    <h4>Metode Pengiriman</h4>
                    <p>{{ $order->shipping_method }}</p>
                </div>
                <div class="info-block">
                    <h4>Metode Pembayaran</h4>
                    <p>{{ $order->payment_method }}</p>
                </div>
            </div>

            <p class="items-label">Detail Produk</p>
            <div class="table-responsive">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>
                                <div class="item-cell">
                                    @php
                                        $imgUrl = $item->variant?->images?->first()?->image_url ?? null;
                                        if ($imgUrl) {
                                            $imgSrc = str_starts_with($imgUrl, 'assets/') || str_starts_with($imgUrl, 'image/')
                                                ? asset($imgUrl)
                                                : asset('storage/' . $imgUrl);
                                        } else {
                                            $imgSrc = asset('assets/img/placeholder.png');
                                        }
                                    @endphp
                                    <img class="item-img"
                                        src="{{ $imgSrc }}"
                                        alt="{{ $item->variant?->product?->product_name }}">
                                    <span>
                                        <div class="item-name">{{ $item->variant?->product?->product_name ?? '-' }}</div>
                                        <div class="item-variant">{{ $item->variant?->size }} / {{ $item->variant?->color }}</div>
                                    </span>
                                </div>
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="totals">
                <div class="total-row-inv">
                    <span>Subtotal Produk</span>
                    <span>Rp {{ number_format($order->total_product_price, 0, ',', '.') }}</span>
                </div>
                <div class="total-row-inv">
                    <span>Ongkos Kirim</span>
                    <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                </div>
                <div class="total-row-inv grand">
                    <span>Total</span>
                    <span>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- FOOTER CARD --}}
        <div class="invoice-footer">
            <div class="footer-note">
                Terima kasih sudah berbelanja di <strong>Savior World</strong>!
            </div>
            <div class="footer-note web-link">saviorworld.id</div>
        </div>

    </div>

    {{-- ACTIONS BUTTON --}}
    <div class="invoice-actions">
        <a href="{{ url('/orders') }}" class="btn-back">← Riwayat Pesanan</a>
        <button class="btn-print" id="btnPrintInvoice">🖨️ Print Invoice</button>
    </div>
</main>
@endsection
@push('scripts')
<script src="{{ asset('js/page/invoice.js') }}"></script>
@endpush