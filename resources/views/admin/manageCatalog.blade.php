@extends('layouts.admin')

@section('title', 'Manage Catalog')

@push('style')

<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/manageCatalog.css') }}">

@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <h1 class="page-title">
                Manage Catalog
            </h1>

            <div class="content-card">

                <p>
                    Halaman manage catalog sementara.
                </p>

            </div>

        </section>

    </section>

</main>

@endsection