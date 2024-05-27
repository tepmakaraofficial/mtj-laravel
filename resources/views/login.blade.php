@extends('layout.master')
@section('title','Welcome to MTJ. Please sign in first.')
@section('style')
<style>
    .loginContainer{
        padding: 5%;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    body, .dark{   
        height: 550px;
        background: #2d2d2d;
        background-size: 70%;
        background-repeat: no-repeat;
        background-position: right bottom;
        background-image: url("{{url('images/MTJ background.png')}}");
    }
    @media (max-width: 1189px) {
        body, .dark{   
                background: #2d2d2d;
                background-size: 80%;
                background-repeat: no-repeat;
                background-position: 80% 12%;
                background-image: url("{{url('images/MTJ background.png')}}");
        }
        .video{
            width: 100% !important;
            height:250px;
            border-radius:9px;
        }
    }
    @media (max-width: 789px) {
        body, .dark{   
                background: #2d2d2d;
                background-size: 80%;
                background-repeat: no-repeat;
                background-position: 80% 12%;
                background-image: url("{{url('images/MTJ background.png')}}");
        }
        .video{
            width: 100% !important;
            height:250px;
            border-radius:9px;
        }
    }
    .video{
        width: 70%;
        height:250px;
        border-radius:9px;
    }
    .headLabel{
        color:#198754;
    }
    .dark .headLabel{
        color:#4bc48b;
    }
    .headLabel1{
        color:#2d2d2d;
    }
    .dark .headLabel1{
        color:#d0d0d0;
    }
    .firebaseui-idp-button, .firebaseui-tenant-button {
        direction: ltr;
        font-weight: 500;
        height: auto;
        line-height: normal;
        max-width: 220px;
        border-radius: 9px !important;
        background-color: #f3f3f3 !important;
        min-height: 40px;
        padding: 8px 16px;
        text-align: left;
        width: 100%;
    }
</style>
@endsection
@section('body')
@vite(['resources/js/login.js'])
<div class="container">
    <div >
        
    </div>
</div>
<div class="container-fluid loginContainer">
   
    <div class="row">
        <div class="col-12 col-lg-6 col-md-12 col-sm-12">
            <img src="{{url('images/M.T.J logo.png')}}" style="width: 15%;margin-bottom:3%;" alt="" srcset="">
            <h3 class="headLabel"><i class="fa fa-line-chart" aria-hidden="true"></i> {{translator('MTJ is your trademate.')}}</h3>
            <p class="headLabel1">{!!getDefDescOnWelcome()!!}</p>
            <div style="float: left; border:1px #d7d7d9 solid; border-radius:7px;padding:2%;margin-bottom:2%;">
                <h5 class="headLabel">Please sign in to get started.</h5>
                <div id="firebaseui-auth-container"></div>
                <div id="dynamic-form-container"></div>
            </div>
            @php
                $pageVideoId = setting('site.welcome_page_video_id');
            @endphp
            @if (!empty($pageVideoId))
            <iframe class="video" src="https://www.youtube.com/embed/{{$pageVideoId}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            @endif
            
        </div>
        <div class="col">
            
        </div>
    </div>
</div>
@endsection