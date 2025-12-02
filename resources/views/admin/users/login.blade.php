<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      Admin Login
    </title>
    <link rel="icon" href="{{ asset('assets/image/favicon/favicon-32x32.png') }}"
    type="image/png" />
    <link href="{{ asset('css/admin/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/general.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/icons.css') }}" rel="stylesheet">
    <style>
      body { background: #ffffff !important; height: 100vh; overflow: hidden;
      } .left-section { background-color: #1d1d1d; height: 100vh; display: flex;
      align-items: center; justify-content: center; } .logo-img { width: 70%;
      max-width: 400px; height: auto; } .submit-button { background-color: #1d1d1d;
      color: #fff; border: none; } .submit-button:hover { background-color: #1d1d1d;
      color: #fff; } @media(max-width: 768px) { .left-section { display: none;
      } body { overflow: auto; } }
    </style>
  </head>

  <body>
    <div class="container-fluid h-100 p-0">
      <div class="row g-0 h-100">
        <!-- Left (Logo) -->
        <div class="col-md-6 left-section">
          <img src="{{ asset('assets/image/logo.png') }}" class="logo-img" alt="Logo">
        </div>
        <!-- Right (Login) -->
        <div class="col-md-6 d-flex align-items-center justify-content-center p-4">
          <div class="w-75">
            <h3 class="text-center mb-4">
              Admin Login
            </h3>
            @if (session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
            @endif
            <form action="{{ route('checklogin') }}" id="checkloginform">
              @csrf
              <label class="form-label fw-bold">
                Email
              </label>
              <input type="text" class="form-control mb-3" name="email" id="inputEmailAddress"
              placeholder="Email Address">
              <label class="form-label fw-bold">
                Password
              </label>
              <input type="password" class="form-control mb-4" name="password" id="inputChoosePassword"
              placeholder="Enter Password">
              <button type="submit" class="btn submit-button w-100" id="checklogin">
                <i class="bx bxs-lock-open">
                </i>
                Sign in
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('js/admin/jquery.min.js') }}">
    </script>
    <script>
      $(document).ready(function() {
        $("#show_hide_password a").on('click',
        function(event) {
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
      $('#checklogin').on('click',
      function() {
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
        if (valid == true) {
          $('#checkloginform').submit();
        } else {
          return false;
        }
      });
    </script>
  </body>

</html>
