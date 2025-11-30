<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/image/logo.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/image/logo.png') }}" class="logo-icon" alt="logo icon">
        </div>

    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('user-dashboard') }}">
                <div class="parent-icon"><i class='fa fa-home' aria-hidden="true"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="{{ route('trades.list') }}">
                <div class="parent-icon"><i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <div class="menu-title">Live Signal</div>
            </a>
        </li>
        <li>
            <a href="{{ route('trading.history') }}">
                <div class="parent-icon"><i class="fa fa-user" aria-hidden="true"></i>
                </div>
                <div class="menu-title">Signal History</div>
            </a>
        </li>

        <li>
            <a href="{{ route('user-signout') }}">
                <div class="parent-icon"><i class="fa fa-sign-out" aria-hidden="true"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
