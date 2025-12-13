@extends('layouts.default')
@section('content')
    <section id="contact" class="p-1 contact section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Register</h2>
            <p>
                <span>Already have an account ?</span> <a href="{{ route('signIn') }}" class="font-weight-bold">Login</a>
            </p>
        </div>
        <!-- End Section Title -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row align-items-stretch">
                <div class="col-lg-12" data-aos="fade-right" data-aos-delay="200">
                    <div class="contact-form-container">

                        <form action="{{ route('signUpSubmit') }}" method="post" id="lrf-form" class="contact-form" autocomplete="off">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-field">
                                                <input type="text" name="name" class="form-input" id="userName" placeholder="Your Name" required="">
                                                <label for="userName" class="field-label">Name</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-field">
                                                <input type="email" class="form-input" name="email" id="userEmail" placeholder="Your Email" required="">
                                                <label for="userEmail" class="field-label">Email</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-field">
                                                <input type="password" name="password" class="form-input" id="userPassword" placeholder="Your Password" required="">
                                                <label for="userPassword" class="field-label">Password</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-field">
                                                <input type="password" class="form-input" name="confirm_password" id="userConfirmPassword" placeholder="Confirm Password" required="">
                                                <label for="userConfirmPassword" class="field-label">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-field">
                                                <input type="tel" class="form-input" name="phone" id="userPhone" placeholder="Your Phone">
                                                <label for="userPhone" class="field-label">Phone</label>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="send-button">
                                        Register
                                        <span class="button-arrow">→</span>
                                    </button>
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
        var signUpUrl = "{{ route('signUpSubmit') }}";
        var signInUrl = "{{ route('signIn') }}";
    </script>
    <script src="{{ asset('assets/js/sign-up/index.js') }}"></script>
@endsection
