@extends('layouts.default')
@section('content')
    <div class="container">
        <h1>Privacy Policy</h1>
        <p><strong>Last updated:</strong> 01 January 2026</p>

        <p>
            {{ config('constants.SITE_NAME') }} (“we”, “our”, “us”) operates the website
            <a href="{{ url('/') }}">{{ url('/') }}</a>
            (the “Website”). This Privacy Policy explains how we collect, use, disclose,
            and protect your personal information.
        </p>

        <p>By using our Website, you agree to this Privacy Policy.</p>

        <h2>1. Information We Collect</h2>
        <p>We may collect the following personal information:</p>
        <ul>
            <li>Email address</li>
            <li>First name and last name</li>
            <li>Phone number</li>
        </ul>

        <h2>2. How We Use Your Information</h2>
        <ul>
            <li>To communicate with users</li>
            <li>To respond to inquiries or requests</li>
            <li>To provide requested services</li>
            <li>To send transactional or informational emails</li>
        </ul>

        <h2>3. Email Communication</h2>
        <p>
            We send emails only to users who have provided their email address or opted in.
            We use <strong>Brevo</strong> as our email service provider.
        </p>
        <p>
            Brevo Privacy Policy:
            <a href="https://www.brevo.com/legal/privacypolicy/" target="_blank">
                https://www.brevo.com/legal/privacypolicy/
            </a>
        </p>

        <h2>4. Payments</h2>
        <p>
            Payments are processed securely through third-party providers.
            We currently use <strong>PhonePe</strong>.
        </p>
        <p>
            We do not store or process payment card details on our servers.
        </p>
        <p>
            PhonePe Privacy Policy:
            <a href="https://www.phonepe.com/privacy-policy/" target="_blank">
                https://www.phonepe.com/privacy-policy
            </a>
        </p>

        <h2>5. Cookies and Tracking</h2>
        <p>
            We do not use cookies, analytics tools, or advertising services on this Website.
        </p>

        <h2>6. Children’s Privacy</h2>
        <p>
            Our services are not intended for children under the age of 13.
            We do not knowingly collect personal data from children.
        </p>

        <h2>7. Data Security</h2>
        <p>
            We take reasonable measures to protect your personal information.
            However, no method of transmission over the Internet is completely secure.
        </p>

        <h2>8. Business Information</h2>
        <p>
            <strong>{{ config('constants.SITE_NAME') }}</strong><br>
            {{ config('constants.ADMIN_ADDRESS') }}
        </p>

        <h2>9. Contact Us</h2>
        <p>
            If you have any questions regarding this Privacy Policy, contact us at:
            <br>
            Email:
            <a href="mailto:{{ config('constants.ADMIN_EMAIL') }}">
                {{ config('constants.ADMIN_EMAIL') }}
            </a>
        </p>
    </div>
@stop
@section('script')
@endsection
