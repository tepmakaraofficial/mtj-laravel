@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection
@section('script')
    @vite(['resources/js/motivation.js'])
@endsection
@section('title','MTJ - Stay motivated')
@section('body')

    <style>
        .motivationContainer{
            /* position: relative;
            top: 70px;  */
            background-color: #424244;
        }
        body{
            background-color: #424244 !important;
        }
        .videoItem{
            padding: 0.5%;
            /* margin: 0.2%; */
            border:0.5px rgb(113, 113, 113) solid;
            background-color: rgb(66, 65, 65);
            color: rgb(190, 190, 190);
        }
        .videoItem iframe{
            border: 0;
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .videoItem img{
            border: 0;
            border-radius: 15px;
            position: relative;
            display: inline-block;
            width: 100%;
            cursor: pointer;
        }

        .videos{
            padding-top: 3%;
        }
        .navbar{
            background-color: #212529 !important;
            
        }
        
    </style>
    <div class="container-fluid motivationContainer">
        <div class="container-fluid videos">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img src="{{url('images/motivations/do%20not%20quit.jpeg')}}" alt="" style="width: 100%;border-radius:7px;">
                    <img src="{{url('images/motivations/consistency.jpg')}}" alt="" style="width: 100%;border-radius:7px;margin-top:2%;">
                    
                </div>
                <div class="col">
                    <div class="row ">
                        @foreach ($motivations as $motivation)
                            <div class="col-6 col-lg-2 col-md-3 col-sm-12 mb-2  videoItem">
                                <img src="https://i.ytimg.com/vi/{{$motivation->content}}/hqdefault.jpg" onclick="viewVideo('{{$motivation->content}}')" />
                                <div class="container">
                                    <h6 style="padding-top:0.7%;">{{$motivation->title}}</h6>
                                    <div><i class="bi bi-heart{{$motivation->liked==1?"-fill":""}}" style="color: rgb(20, 158, 30);font-size:125%;cursor:pointer;" onclick="loveOrNot(this,{{$motivation->id}})"></i> <span id="totalLike{{$motivation->id}}">{{$motivation->like}}</span></div>
                                </div>
                            </div> 
                        @endforeach
                      
                    </div>
                    {!! $motivations->appends([])->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection