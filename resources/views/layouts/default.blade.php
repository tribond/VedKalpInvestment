<!doctype html>
<html>
<head>
    @include('includes.head')
    @yield('style')
</head>
    <body>
        <div class="page-main">
            @yield('content')
        </div>
        @include('includes.page-scripts')
        @yield('script')
    </body>
</html>
