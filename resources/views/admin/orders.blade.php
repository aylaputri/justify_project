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

            <h1 class="page-title">
                Orders
            </h1>

            <div class="content-card">

                <p>
                    Halaman orders sementara.
                </p>

            </div>

        </section>

    </section>

</main>

@endsection