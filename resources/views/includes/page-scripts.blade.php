<!-- ##### All Javascript Files ##### -->
<!-- jQuery-2.2.4 js -->
<script src="{{ asset('assets/js/jquery/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('assets/js/cookie/cookie.min.js') }}"></script>
<!-- Popper js -->
<script src="{{ asset('assets/js/bootstrap/popper.min.js') }}"></script>
<!-- All Plugins js -->
<script src="{{ asset('assets/js/plugins/plugins.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>

<script>
    window.siteUrl = "{{ url('/') }}";
    window.assetsUrl = "{{ asset('/') }}";
</script>

<!-- Active js -->
<script src="{{ asset('assets/js/active.js') }}"></script>