@extends('layouts.default')
@section('content')
    <section id="services" class="services section light-background">
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-5 justify-content-center">
                <div class="col-lg-6 col-md-6 m-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item text-center" style="box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);">
                        <div class="service-icon mb-3 m-auto">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </div>
                        <h3>All Services</h3>
                        <a href="{{ route('services') }}" class="service-link">
                            <span>View</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 m-0 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item text-center" style="box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);">
                        <div class="service-icon mb-3 m-auto">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <h3>Payment History</h3>
                        <a href="{{ route('payment.history') }}" class="service-link">
                            <span>View</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@stop
@section('script')
@endsection
