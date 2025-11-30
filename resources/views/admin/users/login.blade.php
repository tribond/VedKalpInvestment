<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--favicon-->
		<link rel="icon" href="{{ asset('assets/image/favicon/favicon-32x32.png') }}" type="image/png" />
		<!-- loader-->
		<link href="{{ asset('css/admin/pace.min.css') }}" rel="stylesheet" />
		<script src="{{ asset('js/admin/pace.min.js') }}"></script>
		<!-- Bootstrap CSS -->
		<link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin/general.css') }}" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
		<link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/admin/icons.css') }}" rel="stylesheet">
		<title>Login</title>
	</head>
<body class="bg-login">
	<!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="card" style="background-color:#252928 !important;">
                            <div class="card-body">
                                <div class="p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="" style="color: #FFF;">Admin Login</h3>
                                    </div>
                                    @if (session('error'))
                                        <div class="alert alert-danger">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                    <div class="form-body">
                                        <form class="row g-3" action="{{route('checklogin')}}" id="checkloginform">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label" style="color:#FFF">Email</label>
                                                <input type="text" name="email" class="form-control" id="inputEmailAddress" placeholder="Email Address">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label" style="color:#FFF">Password</label>
                                                <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password">
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn submit-button" id="checklogin"><i class="bx bxs-lock-open"></i>Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
	<!--end wrapper-->
<style>
    .submit-button {
        color: #fff;
        background-color: #003E77;
        border-color: #003E77;
    }
</style>
	<!--plugins-->
	<script src="{{ asset('js/admin/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
        $('#checklogin').on('click', function() {
            $(".error").remove();
            var valid = true;

            var inputEmailAddress = $("#inputEmailAddress").val();
            if (inputEmailAddress == '') {
                $('#inputEmailAddress').after('<span class="error">Email is required.</span>');
                var valid = false;
            }
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(inputEmailAddress)) {
                $('#inputEmailAddress').after('<span class="error">Please enter a valid email address.</span>');
                var valid = false;
            }

            var inputChoosePassword = $("#inputChoosePassword").val();
            if (inputChoosePassword == '') {
                $('#inputChoosePassword').after('<span class="error">Password is required.</span>');
                var valid = false;
            }

            if(valid == true){
                $('#checkloginform').submit();
            }else{
                return false;
            }
        });
    </script>
</body>
</html>
