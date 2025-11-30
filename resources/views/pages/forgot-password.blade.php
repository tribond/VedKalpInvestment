@extends('layouts.default-without-header-footer')
@section('style')
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-image: url({{ asset('assets/image/login-bg.jpg') }});
            background-position: left;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container-fluid {
            height: 100vh;
            background: rgb(0 0 0 / 20%);
        }

       
    </style>
@stop
@section('content')
    <div class="logo-container-fluid container-fluid d-flex align-items-center justify-content-center px-lg-5 px-md-5 px-0">
        <div class="row w-100">
            <div class="col-12 logo-section">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/image/logo.png') }}" alt="Urban Mantras" class="lrf-logo">
                </a>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="shlok-slides owl-carousel">
                    @php
                        $shlokas = config('constants.Sholkas');
                    @endphp
                    @foreach ($shlokas as $shlok)
                        <div class="slide">
                            <i class="fa fa-quote-left mr-1"></i>
                            {{ $shlok }}
                            <i class="fa fa-quote-right ml-1"></i>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="lrf-form px-4 py-5 rounded shadow bg-white">
                    <h2 class="text-center">Forgot Password?</h2>
                    <div class="small text-center mb-4">No Worries, We’ll Help You Recover Your Password.</div>
                    <form id="lrf-form">
                        <div class="form-fields-container">
                            <div class="mb-3">
                                <label for="username" class="form-label">Email</label>
                                <input type="text" id="username" name="email" class="form-control" placeholder="Enter Your Email">
                            </div>
                        </div>
                        <button type="submit" class="btn alazea-btn">Submit</button>
                    </form>
                    <div class="mt-4 text-center font-weight-bold">
                        <span>Remember Password ?</span> <a href="{{ route('signIn') }}" class="text-primary font-weight-bold">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{ asset('assets/js/form-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validate/additional-methods.min.js') }}"></script>
@endsection
