@extends('layouts.admin')

@section('title', 'Staff')

@push('style')
<link
    rel="stylesheet"
    href="{{ asset('css/page/admin/staffs.css') }}">
@endpush

@section('content')

<main class="dashboard-page">

    @include('components.admin.sidebar')

    <section class="dashboard-content">

        @include('components.admin.topbar')

        <section class="page-content">

            <div class="staff-header-block">
                <h1 class="page-title">Users Staf Admin</h1>
                <p class="page-subtitle">Mengawasi akses administrasi. Mengelola izin, mengaudit aktivitas staf, dan menambah akun baru.</p>
            </div>

            <div class="action-bar-wrapper">
                <div class="search-box-container">
                    <span class="search-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.604 10.604Z" />
                        </svg>
                    </span>
                    <input type="text" placeholder="Cari berdasarkan ID, nama lengkap, atau email" class="search-input-field">
                </div>

                <div class="right-actions-group">
                    <button class="btn-filter-dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="icon-svg-small">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                        Status
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="icon-arrow-down">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <button class="btn-add-staff"><span class="plus-sign">+</span> Tambah akun staf</button>
                </div>
            </div>

            <div class="content-card table-responsive-wrapper">
                <table class="staff-data-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Izin Akses</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staffs as $staff)
                        <tr class="{{ $staff->status == 'Non Aktif' ? 'row-disabled' : '' }}">
                            <td class="font-bold-name {{ $staff->status == 'Non Aktif' ? 'text-muted' : '' }}">{{ $staff->name }}</td>
                            <td class="role-text {{ $staff->status == 'Non Aktif' ? 'text-muted' : '' }}">{{ $staff->role }}</td>
                            <td class="permission-code {{ $staff->status == 'Non Aktif' ? 'text-muted-light' : '' }}">{{ $staff->permissions }}</td>
                            <td>
                                <span class="badge-status {{ $staff->status == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                                    {{ $staff->status }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons-flex">
                                    <a href="{{ route('staffs.edit', $staff->id_admin) }}" class="btn-action-edit" title="Edit Data Staf">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="icon-svg-small"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                                    </a>

                                    <form action="{{ route('staffs.destroy', $staff->id_admin) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus staf ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete" title="Hapus Akun Staf">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="icon-svg-small"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </section>

    </section>

</main>

@endsection