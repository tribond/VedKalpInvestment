<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="top-menu ms-auto flex flex-row">
                @php
                    $angelTokenAlive = '';
                    if(session('angel_token_alive') == true) {
                        $angelTokenAlive = 'checked';
                    }
                @endphp
                <div class="form-check form-switch green">
                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" {{ $angelTokenAlive }}>
                    <label class="form-check-label" for="flexSwitchCheckDefault">ANGEL CONNECT</label>
                </div>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('images/admin/avatars/user-profile.png') }}" class="user-img" alt="user avatar">
                    <div class="user-info ps-3">
                        <p class="user-name mb-0">
                            @if (auth()->check())
                                Welcome, {{ auth()->user()->name }}
                            @endif
                        </p>
                    </div>
                </a>
            </div>
        </nav>
    </div>
</header>

<script>
    document.getElementById('flexSwitchCheckDefault').addEventListener('change', function(e) {
        e.preventDefault();
        if (this.checked) {
            var connectTradingUrl = 'https://smartapi.angelone.in/publisher-login?api_key={{env("ANGELONE_API_KEY")}}&state=statevariable';
            window.open(connectTradingUrl, '_blank');
        } else {
            var disconnectTradingUrl = '{{route("disconnect.trading.account")."?api_key=".env("ANGELONE_API_KEY")."&state=statevariable"}}';
            window.open(disconnectTradingUrl);
        }
    });
</script>
<!--end header -->
