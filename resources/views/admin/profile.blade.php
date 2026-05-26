@extends('layouts.admin')

@section('title', 'Profile Admin')

@push('style')

<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/profile.css') }}">

@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <h1 class="page-title">
                Profile Admin
            </h1>

            <div class="content-card">

                <p>
                    Halaman profile admin sementara.
                </p>

            </div>

        </section>

    </section>

</main>

@endsection