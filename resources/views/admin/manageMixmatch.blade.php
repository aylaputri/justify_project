@extends('layouts.admin')

@section('title', 'Manage Mixmatch')

@push('style')

<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/manageMixmatch.css') }}">

@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <h1 class="page-title">
                Manage Mix & Match
            </h1>

            <div class="content-card">

                <p>
                    Halaman manage mix & match sementara.
                </p>

            </div>

        </section>

    </section>

</main>

@endsection