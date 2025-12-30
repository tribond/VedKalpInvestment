@extends('layouts.default')
@section('content')
    <div class="container">
        <h1>Terms & Conditions</h1>
        <p><strong>Last updated:</strong> 01 January 2026</p>

        <p>
            Welcome to {{ config('constants.SITE_NAME') }}.
            By accessing or using this Website, you agree to be bound by these Terms & Conditions.
        </p>

        <h2>1. Use of Website</h2>
        <ul>
            <li>You must use the Website for lawful purposes only</li>
            <li>You must not misuse or attempt unauthorized access</li>
            <li>You must not disrupt or damage the Website</li>
        </ul>

        <h2>2. Services</h2>
        <p>
            {{ config('constants.SITE_NAME') }} provides investment-related information and services.
            All information is provided for general purposes only.
        </p>

        <h2>3. User Responsibilities</h2>
        <ul>
            <li>You agree that information provided by you is accurate</li>
            <li>You are responsible for your actions on the Website</li>
            <li>You must not violate applicable laws or regulations</li>
        </ul>

        <h2>4. Payments</h2>
        <p>
            Payments for products or services are processed through third-party gateways,
            including PhonePe. We do not store payment information.
        </p>

        <h2>5. Intellectual Property</h2>
        <p>
            All content on this Website, including text, logos, and design,
            is the property of {{ config('constants.SITE_NAME') }} unless stated otherwise.
        </p>

        <h2>6. Limitation of Liability</h2>
        <p>
            {{ config('constants.SITE_NAME') }} shall not be liable for any direct or indirect loss
            arising from the use of this Website or its services.
        </p>

        <h2>7. Termination</h2>
        <p>
            We reserve the right to suspend or terminate access to the Website
            if these Terms are violated.
        </p>

        <h2>8. Governing Law</h2>
        <p>
            These Terms shall be governed by the laws of India,
            with jurisdiction in the state of Gujarat.
        </p>

        <h2>9. Contact Information</h2>
        <p>
            Email:
            <a href="mailto:{{ config('constants.ADMIN_EMAIL') }}">
                {{ config('constants.ADMIN_EMAIL') }}
            </a>
        </p>
    </div>
@stop
@section('script')
@endsection
