<!doctype html>
<html>
<head>
    @include('includes.head')
    @yield('style')
</head>
    <body>
        @include('includes.header')
        <main class="main">
            @yield('content')
        </main>
        @include('includes.footer')
        @include('includes.page-scripts')
        @yield('script')
    </body>
</html>
