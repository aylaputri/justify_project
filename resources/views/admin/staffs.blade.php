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
                <p class="page-subtitle">Mengawasi akses administrasi. Mengelola data akun staf dan menambahkan akun baru.</p>
            </div>

            @if(session('success'))
                <div style="background-color: #e8f5e9; color: #2e7d32; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: bold; border-left: 5px solid #2e7d32;">
                    👍 {{ session('success') }}
                </div>
            @endif

            <div class="action-bar-wrapper">
                
                <form action="{{ route('staffs.index') }}" method="GET" class="search-box-container" style="display: flex; width: 100%; max-width: 400px; margin: 0;">
                    <span class="search-icon-wrapper" style="cursor: pointer;" onclick="this.closest('form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="icon-svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.604 10.604Z" />
                        </svg>
                    </span>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Cari berdasarkan nama atau role..." 
                        class="search-input-field"
                        style="width: 100%;"
                        onkeyup="if(event.key === 'Enter') this.form.submit();">
                </form>

                <div class="right-actions-group">
                    @if(request('search'))
                        <a href="{{ route('staffs.index') }}" class="btn-add-staff" style="background-color: #616161; text-decoration: none; margin-right: 10px;">Reset Pencarian</a>
                    @endif

                    <a href="{{ route('staffs.create') }}" class="btn-add-staff" style="text-decoration: none; display: inline-flex; align-items: center;">
                        <span class="plus-sign">+</span> Tambah akun staf
                    </a>
                </div>
            </div>

            <div class="content-card table-responsive-wrapper">
                <table class="staff-data-table">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staffs as $staff)
                        <tr>
                            <td class="font-bold-name">{{ $staff->username }}</td>
                            
                            <td>{{ $staff->name }}</td>
                            
                            <td class="role-text">{{ $staff->role }}</td>
                            
                            <td>
                                <div class="action-buttons-flex" style="justify-content: center;">
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
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 30px; color: #757575; font-style: italic;">
                                Data staf tidak ditemukan atau belum terdaftar.
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