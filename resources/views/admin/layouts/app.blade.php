<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!--favicon-->
	<link rel="icon" href="{{asset('assets/image/favicon/favicon-32x32.png')}}" type="image/png" />
	<!--plugins-->
	@yield("style")
	<link href="{{asset('plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('css/admin/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('js/admin/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
    <link href="{{asset('css/admin/general.css')}}" rel="stylesheet">
	<link href="{{asset('css/admin/bootstrap.min.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('css/admin/app.css')}}" rel="stylesheet">
	<link href="{{asset('css/admin/icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset('css/admin/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{asset('css/admin/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{asset('css/admin/header-colors.css')}}" />
    <title>{{ env('APP_NAME') }} Admin</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--start header -->
		@include("admin.layouts.header")
		<!--end header -->
		<!--navigation-->
		@include("admin.layouts.nav")
		<!--end navigation-->
		<!--start page wrapper -->
		@yield("wrapper")
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright © <?php echo date('Y'); ?>. All right reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->
    <!--start switcher-->
    
    <!--end switcher-->
    <!--plugins-->
	<script src="{{asset('js/admin/jquery.min.js')}}"></script>
    <script src="{{asset('js/admin/general-validations.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('js/admin/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<!--app JS-->
	<script src="{{asset('js/admin/app.js')}}"></script>
	@yield("script")
</body>

</html>
