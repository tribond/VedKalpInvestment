@extends('layouts.default')
@section('content')
    <section id="pricing" class="pricing section">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Services</h2>
            <p>Check our Services</p>
        </div>
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4 justify-content-center">
                @foreach ($services as $service)
                    <div class="col-lg-4 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                        <article class="price-card h-100">
                            <div class="card-head">
                                <span class="badge-title">{{ $service->subscription_type }}</span>
                                <h3 class="title">{{ $service->title }}</h3>
                                <div class="price-wrap">
                                    <span class="price price-monthly">
                                        <sup>₹</sup>{{ $service->subscription_amount }}
                                        @if ($service->subscription_duration == 'monthly')
                                            <span class="period">/mo</span>
                                        @elseif($service->subscription_duration == 'yearly')
                                            <span class="period">/yr</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            {!! $service->description !!}
                            <div class="cta">
                                <a href="#" class="btn btn-choose w-100">Subscribe Now</a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@stop
@section('script')
@endsection
