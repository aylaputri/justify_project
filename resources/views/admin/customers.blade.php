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

            <div class="staff-header-block">
                <h1 class="page-title">Users Customer Admin</h1>
                <p class="page-subtitle" style="color: #666; margin-top: 5px; font-size: 14px;">Kelola dan pantau akses customer global Savior World.</p>
            </div>

            <div class="action-bar-wrapper" style="display: flex; justify-content: space-between; align-items: center; margin: 20px 0; gap: 15px;">
                
                <form action="{{ route('customers.index') }}" method="GET" style="display: flex; width: 100%; max-width: 500px; margin: 0;">
                    <div class="search-box-container" style="display: flex; align-items: center; width: 100%; background: #f5f5f5; border-radius: 8px; padding: 8px 16px; border: 1px solid #e0e0e0;">
                        <span style="margin-right: 10px; color: #888; display: flex; align-items: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 20px; height: 20px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.604 10.604Z" />
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari berdasarkan nama lengkap, atau email..." 
                            style="border: none; background: transparent; width: 100%; outline: none; font-size: 14px;"
                            onkeyup="if(event.key === 'Enter') this.form.submit();">
                    </div>
                </form>

                <div class="right-actions-group" style="display: flex; gap: 10px; align-items: center;">
                    @if(request('search'))
                        <a href="{{ route('customers.index') }}" style="background-color: #616161; text-decoration: none; padding: 10px 15px; border-radius: 8px; color: #fff; font-size: 14px; font-weight: bold;">Reset Filter</a>
                    @endif
                    
                    <button class="btn-filter-dropdown" style="display: flex; align-items: center; gap: 8px; background: #fff; border: 1px solid #ccc; padding: 10px 16px; border-radius: 8px; font-size: 14px; cursor: pointer; font-weight: 500;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 16px; height: 16px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                        </svg>
                        Status
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 14px; height: 14px; margin-left: 5px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="content-card" style="background: #fff; border-radius: 12px; border: 1px solid #e0e0e0; overflow: hidden; padding: 0;">
                
                <table class="staff-data-table" style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead style="background-color: #d6d6d6; color: #1a1a1a; font-weight: bold;">
                        <tr>
                            <th style="padding: 16px; font-size: 14px;">ID</th>
                            <th style="padding: 16px; font-size: 14px;">Nama Lengkap</th>
                            <th style="padding: 16px; font-size: 14px;">Email</th>
                            <th style="padding: 16px; font-size: 14px;">Total Orders</th>
                            <th style="padding: 16px; font-size: 14px; text-align: center;">Status</th>
                            <th style="padding: 16px; font-size: 14px; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr style="border-bottom: 1px solid #eee; transition: background 0.2s; background: {{ $customer->is_active ? '#fff' : '#f9f9f9' }}">
                            
                            <td style="padding: 16px; font-weight: 500; color: #555; font-size: 14px;">#{{ $customer->id_user }}</td>
                            
                            <td style="padding: 16px; font-weight: bold; color: #111; font-size: 14px;">{{ $customer->full_name }}</td>
                            
                            <td style="padding: 16px; color: #666; font-size: 14px;">{{ $customer->email }}</td>
                            
                            <td style="padding: 16px; color: #444; font-weight: 500; font-size: 14px;">0 Orders</td>
                            
                            <td style="padding: 16px; text-align: center;">
                                @if($customer->is_active == 1)
                                    <span style="display: inline-block; padding: 6px 16px; border: 1px solid #2e7d32; color: #2e7d32; background-color: #e8f5e9; border-radius: 20px; font-size: 13px; font-weight: 600;">Aktif</span>
                                @else
                                    <span style="display: inline-block; padding: 6px 16px; border: 1px solid #c62828; color: #c62828; background-color: #ffebee; border-radius: 20px; font-size: 13px; font-weight: 600;">Non Aktif</span>
                                @endif
                            </td>
                            
                            <td style="padding: 16px; text-align: center;">
                                <div style="display: flex; justify-content: center; gap: 12px;">
                                    <a href="#" style="color: #444; text-decoration: none;" title="Edit Customer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 18 height: 18px; width: 18px;"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /></svg>
                                    </a>
                                    <a href="#" style="color: #c62828; text-decoration: none;" title="Hapus Customer">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width: 18px; height: 18px;"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: #888; font-style: italic; background: #fafafa; font-size: 14px;">
                                Tidak ada data customer yang ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div style="background: #d6d6d6; padding: 12px 20px; display: flex; justify-content: space-between; align-items: center; font-size: 14px; color: #333; font-weight: 500;">
                    <div>
                        Menampilkan {{ $customers->firstItem() ?? 0 }} - {{ $customers->lastItem() ?? 0 }} dari {{ $customers->total() }} Customers
                    </div>
                    <div>
                        {{ $customers->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>

        </section>

    </section>

</main>

<style>
    .pagination { display: flex; list-style: none; padding: 0; margin: 0; gap: 5px; }
    .page-item .page-link { color: #1a1a1a; background: #fff; padding: 5px 10px; border-radius: 4px; text-decoration: none; border: 1px solid #ccc; font-size: 12px; font-weight: bold; }
    .page-item.active .page-link { background: #1a1a1a; color: #fff; border-color: #1a1a1a; }
    .page-item.disabled .page-link { color: #999; background: #eee; cursor: not-allowed; }
</style>

@endsection