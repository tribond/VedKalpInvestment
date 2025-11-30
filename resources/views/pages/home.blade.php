@extends('layouts.default')
@section('content')
  <!--wrapper-->
  <div class="wrapper bg-login">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
          <div class="col mx-auto">
            <div class="card" style="background-color:#000000c4 !important;">
              <div class="card-body">
                <div class="text-center">
                  <img src="{{ asset('assets/image/logo.png') }}" class="logo-icon" alt="logo icon">
                  <h3 class="" style="color: #FFF;">Welcome to Ved Kalp Investment</h3>
                </div>
                @if (session('error'))
                  <div class="alert alert-danger">
                    {{ session('error') }}
                  </div>
                @endif
                <div class="form-body px-4">

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
@stop
@section('script')
  <script>
    var signInUrl = "{{ route('signInSubmit') }}";
    var dashboardUrl = "{{ route('dashboard') }}";
  </script>
  <script src="{{ asset('assets/js/form-validate/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/js/form-validate/additional-methods.min.js') }}"></script>
  <script src="{{ asset('assets/js/sign-in/index.js') }}"></script>
@endsection
