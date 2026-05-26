<aside class="sidebar">

    <div class="sidebar-top">

        <!-- HEADER -->
        <div class="sidebar-header">

            <h1 class="sidebar-logo">
                Savior World
            </h1>

        </div>

        <!-- MENU -->
        <nav class="sidebar-menu">

            <!-- DASHBOARD -->
            <a
                href="/admin/dashboard"
                class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">

                <img
                    src="{{ asset('assets/icon/dashboard.svg') }}"
                    alt="Dashboard"
                    class="menu-icon">

                <span>
                    Dashboard
                </span>

            </a>

            <!-- USERS -->
            <div class="menu-dropdown">

                <button class="dropdown-button">

                    <div class="dropdown-left">

                        <img
                            src="{{ asset('assets/icon/users.svg') }}"
                            alt="Users"
                            class="menu-icon">

                        <span>
                            Users
                        </span>

                    </div>

                    <img
                        src="{{ asset('assets/icon/dropdown.svg') }}"
                        alt="Arrow"
                        class="dropdown-arrow 
                        {{ request()->is('admin/customers') || request()->is('admin/staffs') ? 'rotate' : '' }}">

                </button>

                <div class="dropdown-content 
                    {{ request()->is('admin/customers') || request()->is('admin/staffs') ? 'show' : '' }}">

                    <a
                        href="/admin/customers"
                        class="{{ request()->is('admin/customers') ? 'active-child' : '' }}">

                        Customers

                    </a>

                    <a
                        href="/admin/staffs"
                        class="{{ request()->is('admin/staffs') ? 'active-child' : '' }}">

                        Staffs

                    </a>

                </div>

            </div>

            <!-- ORDERS -->
            <a
                href="/admin/orders"
                class="menu-item {{ request()->is('admin/orders') ? 'active' : '' }}">

                <img
                    src="{{ asset('assets/icon/cart.svg') }}"
                    alt="Orders"
                    class="menu-icon">

                <span>
                    Orders
                </span>

            </a>

            <!-- MANAGE HOME -->
            <a
                href="/admin/manage-home"
                class="menu-item {{ request()->is('admin/manage-home') ? 'active' : '' }}">

                <img
                    src="{{ asset('assets/icon/home.svg') }}"
                    alt="Manage Home"
                    class="menu-icon">

                <span>
                    Manage Home
                </span>

            </a>

            <!-- MANAGE CATALOG -->
            <a
                href="/admin/manage-catalog"
                class="menu-item {{ request()->is('admin/manage-catalog') ? 'active' : '' }}">

                <img
                    src="{{ asset('assets/icon/catalog.svg') }}"
                    alt="Manage Catalog"
                    class="menu-icon">

                <span>
                    Manage Catalog
                </span>

            </a>

            <!-- MANAGE MIXMATCH -->
            <a
                href="/admin/manage-mixmatch"
                class="menu-item {{ request()->is('admin/manage-mixmatch') ? 'active' : '' }}">

                <img
                    src="{{ asset('assets/icon/mixmatch.svg') }}"
                    alt="Manage Mixmatch"
                    class="menu-icon">

                <span>
                    Manage Mix & Match
                </span>

            </a>

            <!-- REPORTS -->
            <a
                href="/admin/reports"
                class="menu-item {{ request()->is('admin/reports') ? 'active' : '' }}">

                <img
                    src="{{ asset('assets/icon/reports.svg') }}"
                    alt="Reports"
                    class="menu-icon">

                <span>
                    Reports
                </span>

            </a>

        </nav>

    </div>

    <!-- LOGOUT -->
    <button
        class="logout-button"
        onclick="confirmLogout()">

        <img
            src="{{ asset('assets/icon/logout.svg') }}"
            alt="Logout"
            class="menu-icon">

        <span>
            Logout
        </span>

    </button>

</aside>