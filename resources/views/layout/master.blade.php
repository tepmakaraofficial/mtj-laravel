<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-status-bar-style" content="#212529">
    <meta name="theme-color" content="#212529">
    <meta name="description" content="{{getDefDesc()}}">
    <meta name="keywords" content="{{getDefDesc()}}">
    <meta name="author" content="MTJ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','MTJ is your trademate')</title>
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Your Target Keyword-rich Title | Your Brand Name">
    <meta property="og:description" content="{{getDefDesc()}}">
    <meta property="og:image" content="{{url("images/MTJ-Def.png")}}">
    <meta property="og:url" content="{{url()->full()}}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US">
    <meta property="og:site_name" content="MTJ My Trading Journey">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{url('images/favicon/favicon.ico')}}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{url('images/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{url('images/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{url('images/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{url('images/favicon/site.webmanifest')}}">
    
    @vite(['resources/js/app.js','resources/sass/fontawesome.scss','resources/sass/app.scss'])
    @yield('style')
    @yield('script')
</head>
<body class="{{ strpos(request()->getPathInfo(),'/open/')!==false?'':'dark'}}" style="padding-top: 63px;">
    <div id="preload">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
   </div>
   <div class="content">
        @yield('top')
        @if(session()->has('message'))
            <div class="toast-container" style="position: absolute; top: 10px; right: 10px; background-color:rgb(211, 210, 209);color:#4bc48b;opacity:0.8;">
                <div class="toast show" id="toast" role="alert" aria-live="polite" aria-atomic="true">
                    <div class="toast-body" style="text-align: center;">
                        {{ session()->get('message') }}
                    </div>
                </div>
            </div>
            <script type="module">
                setTimeout(() => {
                    new bootstrap.Toast($("#toast")).hide();
                }, 3500);
            </script>
        @endif
        @yield('body')
    
        @if ((strpos(request()->getPathInfo(),'/trade')!==false || request()->getPathInfo()=='/')&& !($isModal??false))
            @include('layout.sidebar')
        @endif
        @if (request()->getPathInfo()!='/login' && request()->getPathInfo()!='/logout')
            @include('layout.footer')
        @endif
        
        <div class="modal fade" tabindex="-1" id="confirmationModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{translator('Close')}}</button>
                    <a href="#" id="confirmationOkModal"><button type="button" class="btn btn-primary" >{{translator('Yes')}}</button></a>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-xl" tabindex="-1" id="generalModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{translator('Close')}}</button>
                        <a href="#" id="editBtnGeneralModal"><button type="button" class="btn btn-primary" >{{translator('Update')}}</button></a>
                    </div> --}}
                </div>
            </div>
        </div>
   </div>
    
    <script src="{{asset("js/custom.js")}}"></script>
    
</body>
</html>