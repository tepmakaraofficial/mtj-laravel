@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title', 'MTJ - Disclaimer')
@section('body')
    <style>
        .disclaimer h2,
        h3 {
            margin-bottom: 1.5%;
            margin-top: 1.5%;
        }
    </style>
    <div class="container disclaimer">
        <h2 style="text-align: left;">Disclaimer</h2>
        <p>The information provided on this website is for general informational purposes only. All content and materials available on MTJ ("the Site") are provided "as is" without any warranty of any kind, either express or implied, including but not limited to, the implied warranties of merchantability, fitness for a particular purpose, or non-infringement.</p>
        <h3 style="text-align: left;">Trading Risk</h3>
        <p>Trading involves significant risk of loss and may not be suitable for all investors. The high degree of leverage that is often obtainable in trading can work against you as well as for you. The use of leverage can lead to large losses as well as gains. Past performance is not indicative of future results.</p>
        <h3 style="text-align: left;">No Financial Advice</h3>
        <p>The content on this website is not intended to provide financial, investment, legal, tax, or accounting advice. It is for informational purposes only and should not be relied upon as such. You should consult with a qualified professional for advice tailored to your specific circumstances.</p>
        <h3 style="text-align: left;">No Guarantee of Results</h3>
        <p>While we strive to provide accurate and up-to-date information, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or availability of the information, products, services, or related graphics contained on the Site for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p>
        <h3 style="text-align: left;">Limitation of Liability</h3>
        <p>In no event will MTJ, its affiliates, partners, or licensors be liable for any direct, indirect, incidental, special, consequential, or punitive damages, including but not limited to, loss of profits, loss of revenue, loss of data, or other intangible losses arising out of or in connection with your use of the Site or any content or materials available through the Site.</p>
        <h3 style="text-align: left;">Changes to This Disclaimer</h3>
        <p>We reserve the right to update, change, or modify this Disclaimer at any time without prior notice. Any changes will be effective immediately upon posting on this page.</p>
    </div>
@endsection
