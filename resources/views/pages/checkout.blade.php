@extends('layouts.default')
@section('content')
    <section class="checkout section">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Checkout</h2>
            <p>Complete your payment</p>
        </div>
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h5>Order Summary</h5>
                            @foreach($services as $service)
                                <div class="d-flex justify-content-between">
                                    <span>{{ $service->title }} ({{ $service->subscription_type }}) - {{ $service->duration }}</span>
                                    <span>₹{{ $service->amount }}</span>
                                </div>
                            @endforeach
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total</strong>
                                <strong>₹{{ $total }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5>Payment Method</h5>
                            <p>Pay with Paytm</p>
                            <img src="{{ asset('assets/img/paytm-logo.png') }}" alt="Paytm" style="height:40px;">
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-100 mt-3">Pay Now</button>
                            </form>
                            <small class="text-warning d-block mt-2">
                                Gateway activation is pending approval. This is a simulation.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop