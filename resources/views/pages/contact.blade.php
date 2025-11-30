@extends('layouts.default')
@section('content')

    <!-- ##### Breadcrumb Area Start ##### -->
    <div class="breadcrumb-area">
        <!-- Top Breadcrumb Area -->
        <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center">
            <h2>Contact US</h2>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Contact Area Info Start ##### -->
    {{-- <div class="contact-area-info section-padding-0-100">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <!-- Contact Thumbnail -->
                <div class="col-12 col-md-6">
                    <div class="contact--thumbnail">
                        <img src="{{ asset('assets/image/25.jpg') }}" alt="">
                    </div>
                </div>

                <div class="col-12 col-md-5">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <h2>CONTACT US</h2>
                        <p>We are improving our services to serve you better.</p>
                    </div>
                    <!-- Contact Information -->
                    <div class="contact-information">
                        <p><span>Address:</span> 505 Silk Rd, New York</p>
                        <p><span>Phone:</span> +1 234 122 122</p>
                        <p><span>Email:</span> info.deercreative@gmail.com</p>
                        <p><span>Open hours:</span> Mon - Sun: 8 AM to 9 PM</p>
                        <p><span>Happy hours:</span> Sat: 2 PM to 4 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- ##### Contact Area Info End ##### -->

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area section-padding-100-0 position-relative">
        <div id="particles-js"></div>
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-7 m-auto">
                    <!-- Section Heading -->
                    <div class="section-heading">
                        <h2 class="text-white">GET IN TOUCH</h2>
                        <p class="text-white">Send us a message, we will call back later</p>
                    </div>
                    <!-- Contact Form Area -->
                    <div class="contact-form-area mb-100">
                        <form action="#" method="post" id="contactApplication">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Your Name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="Your Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" cols="30" rows="10" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn alazea-btn mt-15">Send Message</button>
                                    <label class="text-success application-success"></label>
                                    <label class="text-error application-error"></label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- <div class="col-12 col-lg-6">
                    <!-- Google Maps -->
                    <div class="map-area mb-100">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3670.150574272067!2d72.54439627519032!3d23.091583179125525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e8317c65a54b5%3A0xf945f09077f04c7b!2sVandemataram%20Rd%2C%20Gota%2C%20Ahmedabad%2C%20Gujarat%20382481!5e0!3m2!1sen!2sin!4v1689421284542!5m2!1sen!2sin" allowfullscreen></iframe>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->

@stop

@section('script')
    <script src="{{ asset('assets/js/particles/particles.min.js') }}"></script>
    <script>
        var contactUsLeadUrl = "{{ route('contactUsLead') }}";

        // for contact us beckground
        particlesJS("particles-js", {
            particles: {
                number: {
                    value: 200,
                    density: {
                        enable: true,
                        value_area: 800,
                    },
                },
                color: {
                    value: "#f0c394",
                },
                opacity: {
                    value: 0.4,
                    random: false,
                    anim: {
                        enable: false,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false,
                    },
                },
                size: {
                    value: 3,
                    random: true,
                    anim: {
                        enable: false,
                        speed: 40,
                        size_min: 0.1,
                        sync: false,
                    },
                },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: "#f0c394",
                    opacity: 0.4,
                    width: 1,
                },
                move: {
                    enable: true,
                    speed: 0.5,
                    direction: "none",
                    random: false,
                    straight: false,
                    out_mode: "out",
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 1200,
                    },
                },
            },
            retina_detect: true,
        });
    </script>
    <script src="{{ asset('assets/js/form-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validate/additional-methods.min.js') }}"></script>
    <script src="{{ asset('assets/js/contact-us/contact-us.js') }}"></script>
@endsection
