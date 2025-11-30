@extends('layouts.default')
@section('content')
<div class="wrapper bg-login">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card" style="background-color:#1b0f1b !important;">
                        <div class="card-body">
                            <div class="p-4 rounded">
                                <div class="text-center">
                                    <h3 class="" style="color: #FFF;">Register</h3>
                                </div>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="form-body">
                                    <form class="row g-2" id="lrf-form" action="#" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name" class="form-label" style="color:#FFF">Name</label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter Your Name">
                                            <label class="error-message"></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="form-label" style="color:#FFF">Email</label>
                                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter Your Email">
                                            <label class="error-message"></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="form-label" style="color:#FFF">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Your Password">
                                            <label class="error-message"></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword" class="form-label" style="color:#FFF">Confirm Password</label>
                                            <input type="password" id="confirmPassword" name="confirm_password" class="form-control" placeholder="Confirm Your Password">
                                            <label class="error-message"></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact" class="form-label" style="color:#FFF">Mobile Number</label>
                                            <input type="text" id="contact" name="mobile_number" class="form-control" placeholder="Enter Your Contact Number">
                                            <label class="error-message"></label>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-grid">
                                                <button type="submit" class="btn submit-button"><i class="bx bxs-lock-open"></i>Sign Up</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mt-2 text-center font-weight-bold" style="color:#FFF">
                                <span>Already have an account ?</span> <a href="{{ url('/') }}" class="font-weight-bold">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .submit-button {
        color: #fff;
        background-color: #003E77;
        border-color: #003E77;
    }
</style>
@stop

@section('script')
    <script>
        var signUpUrl = "{{ route('signUpSubmit') }}";
    </script>
    <script src="{{ asset('assets/js/form-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validate/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/sign-up/index.js') }}"></script>
@endsection
