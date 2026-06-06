@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@push('style')

<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/dashboard.css') }}">

@endpush

@section('content')

<main class="dashboard-page">

    <!-- SIDEBAR -->
    @include('components.admin.sidebar')

    <!-- CONTENT -->
    <section class="dashboard-content">

        <!-- TOPBAR -->
        @include('components.admin.topbar')

        <!-- DASHBOARD BODY -->
        <section class="dashboard-body">

            <h1 class="dashboard-heading">
                Selamat Datang di Halaman Dashboard Super Admin
            </h1>

            <!-- SUMMARY -->
            <div class="summary-cards">

                <div class="summary-card revenue">

                    <span>Total Pendapatan</span>

                    <strong>
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </strong>

                </div>

                <div class="summary-card product">

                    <span>Produk Terjual</span>

                    <strong>
                        {{ $totalProducts }}
                    </strong>

                </div>

                <div class="summary-card orders">

                    <span>Total Orders</span>

                    <strong>
                        {{ $totalOrders }}
                    </strong>

                </div>

                <div class="summary-card customer">

                    <span>Customers</span>

                    <strong>
                        {{ $totalCustomers }}
                    </strong>

                </div>

                <div class="summary-card staff">

                    <span>Staff</span>

                    <strong>
                        {{ $totalStaff }}
                    </strong>

                </div>

            </div>

            <!-- CHART + TOP PRODUCT -->
            <div class="dashboard-grid">

                <div class="sales-card">

                    <h3>
                        Laporan Penjualan
                    </h3>

                    <p>
                        Distribusi pendapatan agregat (6 bulan terakhir)
                    </p>

                    <canvas id="salesChart"></canvas>

                </div>

                <div class="best-product">

                    <h3>
                        Paling Laris Savior
                    </h3>

                    @forelse($topProducts as $product)

                    <div class="best-product-item">

                        <div class="product-image">IMG</div>

                        <div>

                            <p>{{ $product->product_name }}</p>

                            <small>
                                {{ $product->total_sold }} Terjual
                            </small>

                        </div>

                    </div>

                    @empty

                    <p class="empty-data">
                        Belum ada data penjualan
                    </p>

                    @endforelse

                </div>

            </div>

            <!-- RECENT ORDER -->
            <div class="recent-order">

                <div class="recent-order-header">

                    <div>

                        <h3>
                            Pesanan Terbaru
                        </h3>

                        <p>
                            Catatan pesanan terbaru selama satu minggu terakhir
                        </p>

                    </div>

                </div>

                <table>

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Tanggal</th>

                            <th>Customer</th>

                            <th>Status</th>

                            <th>Total</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentOrders as $order)

                        <tr>

                            <td>
                                {{ $order->id }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($order->created_at)->('d-m-Y') }}
                            </td>

                            <td>
                                {{ $order->customer }}
                            </td>

                            <td>
                                <span class="status-badge status-{{ strtolower($order->status) }}">
                                    {{ $order->status }}
                                </span>
                            </td>

                            <td>
                                Rp {{ number_format($order->total,0,',','.') }}
                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="5" class="empty-data">
                                Belum ada data pesanan
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </section>

</main>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/page/admin/dashboard.js') }}"></script>

@endpush