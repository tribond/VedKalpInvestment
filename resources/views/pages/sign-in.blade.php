@extends('layouts.default')
@section('content')
    <section id="contact" class="p-1 contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Login</h2>
            <p>
                <span>Don't have an account ?</span> <a href="{{ route('signUp') }}" class="font-weight-bold">Register</a>
            </p>
        </div>
        <!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-12" data-aos="fade-right" data-aos-delay="200">
                    <div class="contact-form-container">

                        <form action="{{ route('signUpSubmit') }}" method="post" id="lrf-form" class="contact-form" autocomplete="off">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-6">
                                    <div class="col-12">
                                        <div class="form-field">
                                            <input type="email" class="form-input" name="email" id="userEmail" placeholder="Your Email" required="">
                                            <label for="userEmail" class="field-label">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-field">
                                            <input type="password" name="password" class="form-input" id="userPassword" placeholder="Your Password" required="">
                                            <label for="userPassword" class="field-label">Password</label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="send-button">
                                            Login
                                            <span class="button-arrow">→</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


@stop

@section('script')
    <script>
        var signInUrl = "{{ route('signInSubmit') }}";
        var dashboardUrl = "{{ route('dashboard') }}";
    </script>
    <script src="{{ asset('assets/js/sign-in/index.js') }}"></script>
@endsection
