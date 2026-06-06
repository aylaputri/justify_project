@extends('layouts.admin')

@section('title', 'Orders')

@push('style')

<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/orders.css') }}">

@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <h1 class="page-title">Orders Manifest</h1>
            <p class="page-subtitle">Order Savior World</p>

            <div class="orders-top">
                <div>
                    <h3 class="orders-count">Semua Pesanan</h3>
                    <p class="orders-desc">Catatan semua pesanan pada website savior world</p>
                </div>
                <div class="orders-actions">
                    <div class="filter-dropdown">
                        <select id="statusFilter" class="filter-select">
                            <option value="">Status</option>
                            <option value="Pending">Pending</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Dikirim">Dikirim</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                            <option value="Refund">Refund</option>
                        </select>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </div>
                    <button class="csv-btn" onclick="exportCSV()">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        Cetak Csv
                    </button>
                </div>
            </div>

            <div class="orders-wrapper">
                <table class="orders-table" id="ordersTable">
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Customer</th>
                            <th>Tanggal Order</th>
                            <th>Total</th>
                            <th>Shipping</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Resi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr data-status="{{ $order->status }}">
                                <td>{{ $order->id_order }}</td>
                                <td>{{ $order->user?->full_name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                                <td>Rp {{ number_format($order->grand_total, 0, ',', '.') }}</td>
                                <td>{{ $order->shipping_method }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $order->status)) }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>
                                    <button
                                        class="resi-btn"
                                        data-id="{{ $order->id_order }}"
                                        data-status="{{ $order->status }}"
                                        data-resi="{{ $order->tracking_number ?? '' }}">
                                        {{ $order->tracking_number ?? 'no_resi' }}
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-data">Belum ada pesanan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </section>
    </section>
</main>

{{-- MODAL UPDATE ORDER --}}
<div class="overlay-details" id="orderModalOverlay">
    <div class="order-modal">
        <div class="modal-header">
            <h2>Update Order</h2>
            <span class="close" id="closeOrderModal">✕</span>
        </div>
        <div class="modal-body">
            <form id="orderForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="orderId">

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select id="orderStatus" name="status" class="form-input">
                        <option value="Pending">Pending</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Dikirim">Dikirim</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                        <option value="Refund">Refund</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Nomor Resi</label>
                    <input type="text" id="orderResi" name="tracking_number"
                        class="form-input" placeholder="Masukkan nomor resi">
                </div>

                <div class="modal-footer-actions">
                    <button type="button" class="btn-cancel" id="cancelOrderModal">Batal</button>
                    <button type="button" class="btn-save" id="saveOrderBtn">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    const UPDATE_URL = "{{ url('/admin/orders/update') }}";
    const CSRF_TOKEN = "{{ csrf_token() }}";
</script>
<script src="{{ asset('js/page/admin/orders.js') }}"></script>
@endpush