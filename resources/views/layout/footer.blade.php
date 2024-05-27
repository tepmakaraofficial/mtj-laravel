@if(auth()->user() && !traderNothere())
<style>
    .moreInfo{
        padding: 3%;
    }
    .footerContianer{
        background-color: rgb(248 248 248);
    }
    .footerContianer a{
        text-decoration: none;
    }
    .dark .footerContianer{
        background-color: rgb(33 37 41);
    }
    .copyright{
        text-align: center;
        padding-bottom: 2%;
    }
</style>
<div class="container-fluid footerContianer">
    <div class="moreInfo">
        <div class="row">
            <div class="col-lg-4">
                <div class="info">
                    <a class="navbar-brand" href="/"><img src="{{url('images/M.T.J logo.png')}}" style="width: 70px;margin-bottom:2%;" alt="" srcset=""></a>
                    <p>MTJ - Your Ultimate Trading Companion for Consistent Profitability. Keep track of your trades, stay motivated, learn strategies and engage with a community of traders.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="/trade/setting">{{translator('Setup Your Gears')}}</a></li>
                    <li class="list-group-item"><a href="/trade/create-form">{{translator('Add Your Trading Journal')}}</a></li>
                    <li class="list-group-item"><a href="/">{{translator('Analyze Your Performance')}}</a></li>
                    <li class="list-group-item"><a href="/trade/mistake-notes">{{translator('Note Your Mistake Or Best Checklist')}}</a></li>
                    <li class="list-group-item"><a href="/forums">{{translator('Explore Trading Community')}}</a></li>
                    <li class="list-group-item"></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="/from-menus/privacy-policy">{{translator('Privacy Policy')}}</a></li>
                    <li class="list-group-item"><a href="/from-menus/term-of-service">{{translator('Term Of Service')}}</a></li>
                    <li class="list-group-item"><a href="/from-menus/disclaimer">{{translator('Disclaimer')}}</a></li>
                    <li class="list-group-item"><a href="/from-menus/contact-us">{{translator('Contact Us')}}</a></li>
                    <li class="list-group-item"><a href="/from-menus/about-us">{{translator('About Us')}}</a></li>
                    <li class="list-group-item"></li>
                  </ul>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; 2024 - <script>document.write(new Date().getFullYear())</script> <a href="/">MTJ</a> All Rights Reserved</p>
        <p>Developed by Makarablue</p>
    </div>
</div>
@endif