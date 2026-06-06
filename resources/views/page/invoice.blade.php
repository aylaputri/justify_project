@extends('layouts.app')
@section('title', 'Invoice #' . $order->id_order)

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Poppins', sans-serif; background: #f5f5f0; color: #1a1a1a; }

    .invoice-wrap {
        max-width: 720px;
        margin: 40px auto;
        padding: 0 16px 60px;
    }

    /* HEADER */
    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        background: #1a1a1a;
        color: #fff;
        padding: 32px 36px;
        border-radius: 16px 16px 0 0;
    }
    .brand-name { font-size: 22px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; }
    .brand-sub  { font-size: 11px; color: #aaa; letter-spacing: 1px; margin-top: 2px; }
    .invoice-meta { text-align: right; }
    .invoice-meta h2 { font-size: 11px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase; color: #aaa; }
    .invoice-meta .order-id   { font-size: 20px; font-weight: 700; color: #fff; margin-top: 4px; }
    .invoice-meta .order-date { font-size: 12px; color: #888; margin-top: 4px; }

    /* STATUS BANNER */
    .status-banner {
        background: #fff;
        border-left: 4px solid #1a1a1a;
        padding: 14px 36px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #555;
        flex-wrap: wrap;
    }
    .status-badge-inv {
        display: inline-block;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending    { background: #fff3cd; color: #856404; }
    .status-diproses   { background: #cfe2ff; color: #084298; }
    .status-dikirim    { background: #d1ecf1; color: #0c5460; }
    .status-selesai    { background: #d1e7dd; color: #0f5132; }
    .status-dibatalkan { background: #f8d7da; color: #842029; }
    .status-refund     { background: #e2d9f3; color: #432874; }

    /* BODY */
    .invoice-body { background: #fff; padding: 32px 36px; }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 32px;
    }
    .info-block h4 {
        font-size: 10px; font-weight: 600;
        letter-spacing: 1.5px; text-transform: uppercase;
        color: #999; margin-bottom: 8px;
    }
    .info-block p      { font-size: 13px; line-height: 1.7; color: #333; }
    .info-block strong { display: block; font-size: 14px; font-weight: 600; color: #1a1a1a; margin-bottom: 2px; }

    /* TABLE */
    .items-label {
        font-size: 10px; font-weight: 600;
        letter-spacing: 1.5px; text-transform: uppercase;
        color: #999; margin-bottom: 12px;
    }
    .items-table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
    .items-table thead th {
        font-size: 11px; font-weight: 600; color: #999;
        letter-spacing: 0.5px; text-transform: uppercase;
        padding: 8px 0; border-bottom: 1px solid #eee; text-align: left;
    }
    .items-table thead th:last-child,
    .items-table tbody td:last-child { text-align: right; }
    .items-table tbody td {
        padding: 14px 0; font-size: 13px; color: #333;
        border-bottom: 1px solid #f5f5f5; vertical-align: middle;
    }
    .item-img {
        width: 44px; height: 44px; border-radius: 8px;
        object-fit: cover; margin-right: 12px;
        vertical-align: middle; background: #f0f0f0;
    }
    .item-name    { font-weight: 600; color: #1a1a1a; }
    .item-variant { font-size: 11px; color: #999; margin-top: 2px; }

    /* TOTALS */
    .totals { margin-left: auto; width: 280px; }
    .total-row-inv {
        display: flex; justify-content: space-between;
        font-size: 13px; color: #555; padding: 6px 0;
    }
    .total-row-inv.grand {
        font-size: 15px; font-weight: 700; color: #1a1a1a;
        border-top: 2px solid #1a1a1a; margin-top: 6px; padding-top: 10px;
    }

    /* FOOTER */
    .invoice-footer {
        background: #f9f9f7; padding: 20px 36px;
        border-radius: 0 0 16px 16px; border-top: 1px solid #eee;
        display: flex; justify-content: space-between; align-items: center;
    }
    .footer-note { font-size: 12px; color: #999; }
    .footer-note strong { color: #555; }

    /* ACTIONS */
    .invoice-actions {
        display: flex; gap: 12px;
        margin-top: 24px; justify-content: center;
    }
    .btn-print, .btn-back {
        display: flex; align-items: center; gap: 8px;
        padding: 12px 24px; border-radius: 10px;
        font-size: 13px; font-weight: 600;
        cursor: pointer; text-decoration: none;
        font-family: 'Poppins', sans-serif;
    }
    .btn-print { background: #1a1a1a; color: #fff; border: none; }
    .btn-back  { background: #fff; color: #1a1a1a; border: 1.5px solid #ddd; }

    @media print {
        .invoice-actions { display: none; }
        body { background: #fff; }
        .invoice-wrap { margin: 0; padding: 0; }
    }
    @media (max-width: 600px) {
        .info-grid { grid-template-columns: 1fr; }
        .invoice-header { flex-direction: column; gap: 16px; }
        .invoice-meta { text-align: left; }
        .totals { width: 100%; }
        .invoice-header, .invoice-body, .invoice-footer { padding: 24px 20px; }
    }
</style>
@endpush

@section('content')
<div class="invoice-wrap">

    {{-- HEADER --}}
    <div class="invoice-header">
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
                        @php $img = $item->variant?->images?->first(); @endphp
                        <img class="item-img"
                            src="{{ $img ? asset($img->image_url) : asset('assets/img/placeholder.png') }}"
                            alt="{{ $item->variant?->product?->product_name }}">
                        <span>
                            <div class="item-name">{{ $item->variant?->product?->product_name ?? '-' }}</div>
                            <div class="item-variant">{{ $item->variant?->size }} / {{ $item->variant?->color }}</div>
                        </span>
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

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

    {{-- FOOTER --}}
    <div class="invoice-footer">
        <div class="footer-note">
            Terima kasih sudah berbelanja di <strong>Savior World</strong>!
        </div>
        <div class="footer-note">saviorworld.id</div>
    </div>

    <div class="invoice-actions">
        <a href="{{ url('/') }}" class="btn-back">← Kembali Belanja</a>
        <button class="btn-print" onclick="window.print()">🖨️ Print Invoice</button>
    </div>

</div>
@endsection