<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>

    <link rel="icon" href="{{ asset('assets/image/favicon/favicon-32x32.png') }}" type="image/png" />
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/icons.css') }}" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            overflow: hidden;
            color: #fff;
            background: #000 !important;
        }

        .left-section {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0 100px 100px 0;
        }

        .logo-img {
            width: 70%;
            max-width: 380px;
            height: auto;
        }

        .form-box {
            width: 75%;
            max-width: 420px;
        }

        .col-md-6.d-flex {
            background: #000000;
            
        }

        h3 {
            color: #ffffff;
            font-weight: 600;
        }

        /* Input UI */
        .form-control {
            background: #1c1c1c;
            border: 1px solid #333;
            color: #fff;
        }

        .form-control::placeholder {
            color: #8e8e8e;
        }

        .form-control:focus {
            background: #1f1f1f;
            color: #fff;
            border-color: #555;
            box-shadow: none;
        }

        /* Submit button */
        .submit-button {
            background: #e6b800 !important;
            color: #000;
            font-weight: 600;
            border-radius: 6px;
            transition: 0.3s;
        }

        .submit-button:hover {
            background: #cda600 !important;
            transform: translateY(-2px);
        }

        .alert-danger {
            background: #661111;
            border-color: #990000;
            color: #fff;
        }

        /* Mobile */
        @media(max-width: 768px) {
            .left-section {
                height: auto;
                padding: 20px 0;
                display: flex;
            }

            body {
                overflow: auto;
            }

            .row.g-0 {
                flex-direction: column;
            }

            .form-box {
                width: 90% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid h-100 p-0">
        <div class="row g-0 h-100">

            <!-- Left Section (Logo) -->
            <div class="col-md-6 left-section bg-white">
                <img src="{{ asset('assets/img/logo.webp') }}" class="logo-img" alt="Logo">
            </div>

            <!-- Right Section (Login Form) -->
            <div class="col-md-6 d-flex align-items-center justify-content-center p-4">
                <div class="form-box">
                    <h3 class="text-center mb-4">Admin Login</h3>

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('checklogin') }}" id="checkloginform" method="POST">
                        @csrf

                        <label class="form-label fw-bold">Email</label>
                        <input type="text" class="form-control mb-3" name="email" id="inputEmailAddress"
                            placeholder="Email Address">

                        <label class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control mb-4" name="password" id="inputChoosePassword"
                            placeholder="Enter Password">

                        <button type="submit" class="btn submit-button w-100" id="checklogin">
                            Sign In
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/admin/jquery.min.js') }}"></script>

    <script>
        $('#checklogin').on('click', function() {
            $(".error").remove();
            var valid = true;

            var email = $("#inputEmailAddress").val();
            if (email == '') {
                $('#inputEmailAddress').after('<span class="error">Email is required.</span>');
                valid = false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                $('#inputEmailAddress').after('<span class="error">Enter valid email.</span>');
                valid = false;
            }

            var pass = $("#inputChoosePassword").val();
            if (pass == '') {
                $('#inputChoosePassword').after('<span class="error">Password is required.</span>');
                valid = false;
            }

            if (valid === true) {
                $('#checkloginform').submit();
            } else {
                return false;
            }
        });
    </script>
</body>

</html>
