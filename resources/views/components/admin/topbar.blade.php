<header class="topbar">

    <!-- PROFILE -->
    <a
        href="/admin/profile"
        class="admin-profile">

        <div>

            <h3 class="profile-name">
                {{ session('admin_name') }}
            </h3>

            <p class="profile-role">
                {{ session('admin_role') }}
            </p>

        </div>

    </a>

</header>