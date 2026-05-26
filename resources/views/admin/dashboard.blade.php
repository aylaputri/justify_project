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

            <h1 class="page-title">
                Dashboard Admin
            </h1>

            <!-- CARDS -->
            <div class="dashboard-cards">

                <div class="dashboard-card purple">

                    <h3>
                        Total Orders
                    </h3>

                    <p>
                        120
                    </p>

                </div>

                <div class="dashboard-card orange">

                    <h3>
                        Total Revenue
                    </h3>

                    <p>
                        Rp 15M
                    </p>

                </div>

                <div class="dashboard-card blue">

                    <h3>
                        Total Users
                    </h3>

                    <p>
                        58
                    </p>

                </div>

            </div>

            <!-- TABLE -->
            <div class="recent-order">

                <h2>
                    Recent Orders
                </h2>

                <table>

                    <thead>

                        <tr>

                            <th>
                                Customer
                            </th>

                            <th>
                                Product
                            </th>

                            <th>
                                Status
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>
                                Rifdah
                            </td>

                            <td>
                                Savior Hoodie
                            </td>

                            <td>
                                Delivered
                            </td>

                        </tr>

                        <tr>

                            <td>
                                Karina
                            </td>

                            <td>
                                Savior Pants
                            </td>

                            <td>
                                Process
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </section>

    </section>

</main>

@endsection

@push('scripts')

@endpush