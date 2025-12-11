<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header bg-white">
        <div class="m-auto">
            <img src="{{ asset('assets/img/logo.webp') }}" class="logo-icon" alt="VedKalp Investment">
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <div class="sidebar-header bg-white">
        <div class="m-auto">
            <img src="{{ asset('assets/img/logo.webp') }}" class="logo-icon" alt="VedKalp Investment">
        </div>

    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ url('admin/dashboard') }}">
                <div class="parent-icon"><i class='fa fa-home' aria-hidden="true"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('userlist') }}">
                <div class="parent-icon"><i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <div class="menu-title">User Management</div>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}">
                <div class="parent-icon"><i class="fa fa-sign-out" aria-hidden="true"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
