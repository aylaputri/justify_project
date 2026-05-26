@extends('layouts.admin')

@section('title', 'Customers')

@push('style')

<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/customers.css') }}">

@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <h1 class="page-title">
                Customers
            </h1>

            <div class="content-card">

                <p>
                    Halaman customers sementara.
                </p>

            </div>

        </section>

    </section>

</main>

@endsection