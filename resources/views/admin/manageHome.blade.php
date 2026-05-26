@extends('layouts.admin')

@section('title', 'Manage Home')

@push('style')

<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/manageHome.css') }}">

@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <h1 class="page-title">
                Manage Home
            </h1>

            <div class="content-card">

                <p>
                    Halaman manage home sementara.
                </p>

            </div>

        </section>

    </section>

</main>

@endsection