@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title', 'MTJ - About Us')
@section('body')
    <style>
        .disclaimer h2,
        h3 {
            margin-bottom: 1.5%;
            margin-top: 1.5%;
        }
    </style>
    <div class="container disclaimer">
        <h2 style="text-align: left;">About Us</h2>
        <p>Welcome to MTJ, your ultimate trading companion. At MTJ, we're passionate about helping traders achieve their financial goals through informed decision-making, community support, and educational resources.</p>
        <h3 style="text-align: left;">Our Mission</h3>
        <p>Our mission at MTJ is to empower traders of all levels with the tools, knowledge, and support they need to navigate the complex world of trading successfully. We believe in fostering a community of traders who share insights, learn from each other, and strive for continuous improvement.</p>
        <h3 style="text-align: left;">What We Offer</h3>
        <p><b>Trading Journal:</b> Our platform provides traders with a powerful tool to track their trades, analyze performance, and identify areas for improvement. With our intuitive interface and comprehensive features, managing your trading activities has never been easier.</p>
        <p><b>Motivation and Education:</b> We understand that trading can be challenging, and staying motivated is crucial for success. That's why we offer motivational content and educational resources to keep you inspired and informed on your trading journey.</p>
        <p><b>Community Forums:</b> Connect with fellow traders, share strategies, ask questions, and learn from each other in our vibrant community forums. Join discussions, participate in polls, and engage with like-minded individuals passionate about trading.</p>
        <h3 style="text-align: left;">Contact Us</h3>
        <p>We'd love to hear from you! If you have any questions, feedback, or suggestions, please don't hesitate to reach out to us at <a href="/from-menus/contact-us">go to contact page.</a></p>
    </div>
@endsection
