@extends('layouts.app')
@section('title', 'Profile')

@push('style')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Poppins', sans-serif; background: #f5f5f5; }

/* HEADER */
.profile-header {
    background: #1a1a1a;
    padding: 40px 20px 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}
.profile-avatar {
    width: 90px; height: 90px;
    border-radius: 16px;
    object-fit: cover;
    background: #444;
    display: flex; align-items: center; justify-content: center;
    font-size: 36px; color: #fff;
    border: 3px solid #fff;
    position: relative;
}
.profile-avatar img { width: 90px; height: 90px; border-radius: 16px; object-fit: cover; }
.avatar-placeholder {
    width: 90px; height: 90px;
    border-radius: 16px;
    background: #444;
    display: flex; align-items: center; justify-content: center;
    font-size: 36px; color: #fff;
    border: 3px solid #fff;
}
.profile-name  { font-size: 18px; font-weight: 700; color: #fff; }
.profile-email { font-size: 13px; color: #aaa; }

/* MENU CARD */
.profile-body { padding: 16px; margin-top: -24px; display: flex; flex-direction: column; gap: 12px; }

.menu-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
.menu-item {
    display: flex; align-items: center;
    padding: 16px 20px; gap: 14px;
    text-decoration: none; color: #1a1a1a;
    border-bottom: 1px solid #f0f0f0;
    font-size: 14px; font-weight: 500;
    transition: background 0.15s;
}
.menu-item:last-child { border-bottom: none; }
.menu-item:hover { background: #f9f9f9; }
.menu-icon {
    width: 36px; height: 36px;
    border-radius: 10px;
    background: #f0f0f0;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.menu-icon svg { width: 18px; height: 18px; }
.menu-arrow { margin-left: auto; color: #ccc; }

/* PESANAN SAYA */
.orders-card {
    background: #fff;
    border-radius: 16px;
    padding: 16px 20px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
.orders-card-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 16px;
}
.orders-card-header h3 { font-size: 15px; font-weight: 600; }
.orders-card-header span { font-size: 12px; color: #888; }
.orders-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 8px; text-align: center;
}
.order-status-item { display: flex; flex-direction: column; align-items: center; gap: 6px; }
.order-status-icon {
    width: 48px; height: 48px;
    border-radius: 12px;
    background: #f0f0f0;
    display: flex; align-items: center; justify-content: center;
    position: relative;
}
.order-status-icon svg { width: 22px; height: 22px; }
.order-badge {
    position: absolute; top: -4px; right: -4px;
    background: #1a1a1a; color: #fff;
    font-size: 10px; font-weight: 700;
    width: 18px; height: 18px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
}
.order-status-label { font-size: 11px; color: #555; font-weight: 500; }

/* LOGOUT */
.logout-btn {
    display: flex; align-items: center; justify-content: center;
    gap: 10px;
    background: #fff; color: #e53e3e;
    border: none; width: 100%;
    padding: 16px; border-radius: 16px;
    font-size: 15px; font-weight: 600;
    cursor: pointer; font-family: 'Poppins', sans-serif;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    text-decoration: none;
    margin-bottom: 32px;
}
.logout-btn:hover { background: #fff5f5; }
</style>
@endpush

@section('content')

<!-- HEADER -->
<div class="profile-header">
    <div class="avatar-placeholder">
        {{ strtoupper(substr($user->full_name ?? 'U', 0, 1)) }}
    </div>
    <div class="profile-name">{{ $user->full_name ?? '-' }}</div>
    <div class="profile-email">{{ $user->email ?? '-' }}</div>
</div>

<div class="profile-body">

    <!-- MENU -->
    <div class="menu-card">
        <a href="#" class="menu-item">
            <div class="menu-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                </svg>
            </div>
            Edit Profil
            <span class="menu-arrow">›</span>
        </a>
        <a href="{{ url('/address') }}" class="menu-item">
            <div class="menu-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                </svg>
            </div>
            Alamat Pengiriman
            <span class="menu-arrow">›</span>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                </svg>
            </div>
            Metode Pembayaran
            <span class="menu-arrow">›</span>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z"/>
                </svg>
            </div>
            Pusat Bantuan
            <span class="menu-arrow">›</span>
        </a>
    </div>

    <!-- PESANAN SAYA -->
    <div class="orders-card">
        <div class="orders-card-header">
            <h3>Pesanan Saya</h3>
            <span>Geser disini</span>
        </div>
        <div class="orders-grid">
            <!-- PROSES -->
            <div class="order-status-item">
                <div class="order-status-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z"/>
                    </svg>
                    @if($statusCount['Diproses'] > 0)
                    <span class="order-badge">{{ $statusCount['Diproses'] }}</span>
                    @endif
                </div>
                <span class="order-status-label">Proses</span>
            </div>
            <!-- DIKIRIM -->
            <div class="order-status-item">
                <div class="order-status-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/>
                    </svg>
                    @if($statusCount['Dikirim'] > 0)
                    <span class="order-badge">{{ $statusCount['Dikirim'] }}</span>
                    @endif
                </div>
                <span class="order-status-label">Dikirim</span>
            </div>
            <!-- BATALKAN -->
            <div class="order-status-item">
                <div class="order-status-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                    </svg>
                    @if($statusCount['Dibatalkan'] > 0)
                    <span class="order-badge">{{ $statusCount['Dibatalkan'] }}</span>
                    @endif
                </div>
                <span class="order-status-label">Batalkan</span>
            </div>
            <!-- SELESAI -->
            <div class="order-status-item">
                <div class="order-status-icon">
                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                    </svg>
                    @if($statusCount['Selesai'] > 0)
                    <span class="order-badge">{{ $statusCount['Selesai'] }}</span>
                    @endif
                </div>
                <span class="order-status-label">Selesai</span>
            </div>
        </div>
    </div>

    <!-- LOGOUT -->
    <a href="{{ url('/logout') }}" class="logout-btn">
        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="20" height="20">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25"/>
        </svg>
        Keluar
    </a>

</div>

@endsection