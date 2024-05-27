@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title', 'MTJ - Terms of Service')
@section('body')
    <style>
        .termofservice h2,
        h3 {
            margin-bottom: 1.5%;
            margin-top: 1.5%;
        }
    </style>
    <div class="container termofservice">
        <h2 style="text-align: left;"> Terms of Service</h2>
        These Terms of Service ("Terms") govern your use of our website located at <a
        href="{{ url('') }}">{{ url('') }}</a> (the "Site") operated by MTJ ("we", "us", or "our"). Please read these Terms carefully before using the Site.
            <h3 style="text-align: left;">1. General Terms and Conditions:</h3>
            <ul style="text-align: left;">
                <li><b>Acceptance of Terms:</b> By accessing or using the Site, you agree to be bound by these Terms and all applicable laws and regulations. If you do not agree with any of these Terms, you are prohibited from using or accessing the Site.</li>
                <li><b>Intellectual Property:</b> The content, features, and functionality of the Site are owned by MTJ and are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</li>
                <li><b>User Conduct:</b> The content, features, and functionality of the Site are owned by MTJ and are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</li>
                <li><b>Limitation of Liability:</b>  In no event shall MTJ, its affiliates, partners, or licensors be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, arising out of or in connection with your use of the Site.</li>
            </ul>
            <h3 style="text-align: left;">2. Terms of Use for Forums or Community Sections:</h3>
            <ul style="text-align: left;">
                <li><b>User Contributions:</b> Users may contribute content, including comments, messages, and other materials, to forums or community sections of the Site. By posting or submitting content to these sections, you grant us a non-exclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, and display such content throughout the world in any media.</li>
                <li><b>User Conduct:</b> You agree to use the forums or community sections of the Site in a manner consistent with these Terms and all applicable laws and regulations. You are solely responsible for the content you post and the consequences of posting or publishing it.</li>
                <li><b>Moderation:</b> We reserve the right to moderate user-contributed content and remove any content that violates these Terms or is otherwise inappropriate, offensive, or objectionable. We may also suspend or terminate users' access to these sections for violations of these Terms or for any other reason.</li>
            </ul>
            <h3 style="text-align: left;">Contact Us</h3>
            <p>If you have any questions or concerns about these Terms, please contact us at <a href="/from-menus/contact-us">go to contact page.</a></p>
            <h3 style="text-align: left;">Changes to These Terms</h3>
            <p>We may update these Terms from time to time. We will notify you of any changes by posting the new Terms on this page. You are advised to review these Terms periodically for any changes.</p>

    </div>
@endsection
