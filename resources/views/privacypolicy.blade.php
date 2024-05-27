@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title', 'MTJ - Privacy Policy')
@section('body')
    <style>
        .privacy h2,
        h3 {
            margin-bottom: 1.5%;
            margin-top: 1.5%;
        }
    </style>
    <div class="container privacy">
        <h2 style="text-align: left;"> Privacy Policy for MTJ</h2>This Privacy Policy describes how MTJ ("we", "us", or
        "our") collects, uses, and shares personal information when you use our website located at <a
            href="{{ url('') }}">{{ url('') }}</a> (the "Site").
            <h3 style="text-align: left;">Information We Collect</h3>
            <ul style="text-align: left;">
                <li><b>Personal Information:</b> When you visit our website, we may collect certain personal information
                    such as your name, email address, and IP address. We collect this information when you voluntarily
                    submit it to us through contact forms or when you sign up for our newsletter.</li>
                <li><b>Usage Information:</b> We may also collect non-personal information about your visit to the Site,
                    including the pages you viewed, the links you clicked, and the duration of your visit. This information
                    helps us analyze user behavior and improve the functionality of our website.</li>
            </ul>
            <h3 style="text-align: left;">Use of Information</h3>We use the information we collect for the following
            purposes:<br />
            <ul style="text-align: left;">
                <li><b>To provide and maintain the Site:</b> We use your personal information to operate and maintain our
                    website, including providing customer support and sending you updates about our services.</li>
                <li><b>To personalize your experience:</b> We may use your information to personalize your experience on the
                    Site, such as by displaying relevant content based on your interests or preferences.</li>
                <li><b>To send periodic emails:</b> If you opt-in to receive our newsletter, we may use your email address
                    to send you news, updates, or other information related to our website.</li>
            </ul>
            <h3 style="text-align: left;">Sharing of Information</h3>We do not sell, trade, or otherwise transfer your
            personal information to third parties without your consent, except as described in this Privacy Policy. We may
            share your personal information with our affiliates, subsidiaries, and trusted partners who assist us in
            operating our website, providing services to you, or conducting our business, provided that such parties agree
            to keep your information confidential. Additionally, we may display third-party advertisements on our website.
            These advertisers may use technology such as cookies to collect non-personally identifiable information about
            your visits to this website and other websites in order to provide advertisements about goods and services of
            interest to you. We do not provide any personally identifiable information to these advertisers. However, please
            note that if you click on or interact with an advertisement, the advertiser may collect your information through
            their own tracking technologies. We encourage you to review the privacy policies of these advertisers for more
            information on their practices.
            <h3 style="text-align: left;">Cookie Policy</h3>
            <p>Our website uses cookies to enhance user experience. By continuing to use this site, you agree to our use of cookies in accordance with this policy.</p>
            <p>
                <h3 style="text-align: left;">Types of Cookies:</h3>
                <b>1. Essential Cookies:</b> These cookies are necessary for the website to function properly. They include features such as maintaining user sessions, securing the website, and enabling access to specific areas. Users cannot opt out of essential cookies as they are crucial for the website's operation.<br>
                <b>2. Functional Cookies:</b> These cookies enhance the functionality of the website by remembering choices you make, such as dark mode or normal mode preferences, and providing enhanced features. While functional cookies can be disabled through your browser settings, doing so may impact the functionality of certain parts of the website.<br>
                <b>3. Analytical/Performance Cookies:</b> These cookies allow us to analyze how users interact with our website, including which pages are visited most often and how users navigate the site. This information helps us improve the website's performance and user experience. Analytical cookies can be disabled through your browser settings without affecting the functionality of the website.<br>
                <b>4. Advertising/Targeting Cookies:</b> These cookies are used to deliver advertisements relevant to your interests based on your browsing history and preferences. They may also be used to limit the number of times you see an advertisement and measure the effectiveness of advertising campaigns. Advertising cookies can be disabled through your browser settings or through ad network opt-out tools.<br>
                <h3 style="text-align: left;">Managing Cookies:</h3>
                Most web browsers allow you to control cookies through their settings preferences. However, please note that disabling certain types of cookies may impact your experience on the website.
                <br>For more information about cookies and how to manage them, please refer to the help documentation provided by your web browser.<br>
            </p>
        <div>
            <h3 style="text-align: left;">Summary News Feature</h3>Our website may include a summary news feature that
            provides brief news updates sourced from other reputable news websites. These summaries are provided for
            informational purposes only and do not necessarily reflect the views or opinions of MTJ. We strive to ensure the
            accuracy and reliability of the information provided but cannot guarantee its completeness or timeliness.
        </div>
        <div>
            <h3 style="text-align: left;">Contact Us</h3>If you have any questions or concerns about this Privacy Policy,
            please contact us at <a href="/from-menus/contact-us">go to contact page.</a>
        </div>
        <div>
            <h3 style="text-align: left;">Changes to This Privacy Policy</h3>We may update this Privacy Policy from time to
            time. We will notify you of any changes by posting the new Privacy Policy on this page. You are advised to
            review this Privacy Policy periodically for any changes.
        </div>

    </div>
@endsection
