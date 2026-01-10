@extends('layouts.default')
@section('content')
    <section class="cart section">
        <div class="container section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Your Cart</h2>
            <p>Review your selected services</p>
        </div>
        <div class="container aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
            @if($services->isEmpty())
                <div class="text-center">
                    <h4>Your cart is empty</h4>
                    <a href="{{ route('services') }}" class="btn btn-outline-success">Browse Services</a>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-8">
                        @foreach($services as $service)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h5>{{ $service->title }} ({{ $service->subscription_type }})</h5>
                                            <p>{{ $service->duration }} plan</p>
                                            <p>₹{{ $service->amount }}</p>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <form action="{{ route('cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                <button type="submit" class="btn btn-danger">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5>Cart Summary</h5>
                                <p>Total Items: {{ $services->count() }}</p>
                                <p>Total Amount: ₹{{ $services->sum('amount') }}</p>
                                <a href="{{ route('checkout') }}" class="btn btn-success w-100">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@stop