@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title','MTJ - Explore trading news')
@section('body')
@vite(['resources/js/news.js'])
    <style>
        .newsContainer{
            /* position: relative;
            top: 70px;  */
        }
        .newsItem{
            padding: 0.5%;
            /* margin: 0.2%; */
            /* border-radius: 10px; */
            border:0.5px rgb(227, 230, 227) solid;
            background-color: rgb(245, 245, 245);
        }
        .dark .newsItem{
            padding: 0.5%;
            /* margin: 0.2%; */
            /* border-radius: 10px; */
            border:0.5px #57595b solid;
            background-color: #212529;
        }
        .newsItem img{
            border: 0;
            border-radius:7px;
            position: relative;
            display: inline-block;
            width: 100%;
            cursor: pointer;
        }
        .summary {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .ads image{
            margin-bottom: 1%;
        }
        
    </style>
    <div class="container-fluid newsContainer">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-12">
                <div style="width: 100%;padding:2%;">
                    <select name="" id="" class="form-control mb-1" onchange="newsCatChange(this)">
                        @foreach (\App\Models\UserSetting::getTradingType() as $item)
                            <option value="{{strtolower($item->value)}}" {{strtolower($item->value)==request()->get('cat')?'selected':''}}>{{$item->value}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-10 col-md-8 col-sm-12">
                <input type="hidden" id="allPairs" value="{{json_encode($pairs)}}">
                <ul class="nav">
                    @foreach ($pairs as $key=> $val)
                        <li class="nav-item" style="padding-left:3%;"><span style="color: #4bc48b;">{{$val}}<br><span id="{{str_replace(":","",$key)}}" style="color: blue;font-size:85%;text-align:center;">0</span></span></li>
                    @endforeach
                </ul>
               
            </div>
        </div>
        <hr>
        <div class="row">
            @php
                $getCalendarDatas = !empty($getCalendar)?json_decode($getCalendar->data):[];
            @endphp
            <div class="col-lg-10 col-md-12 col-sm-12">
                <div class="container-fluid">
                    <div class="row ">
                        @foreach ($allNews as $news)
                            <div class="col-6 col-lg-2 col-md-3 col-sm-12  mb-2 newsItem">
                                <img src="{{$news->image}}" onclick="viewNew({{$news->id}})" />
                                <div class="container">
                                    <div><a href="#" class="nav-link" style="padding-top:0.7%;" onclick="viewNew({{$news->id}})">{{$news->headline}}</a></div>
                                    <div><p class="summary" style="font-size: 70%;">{{strip_tags($news->summary)}}</p></div>
                                    <div class="row justify-content-between">
                                        <div class="col-6"><span style="color:#4bc48b;font-size: 70%;font-weight:bold;">{{$news->source}}: {{ucwords($news->category)}}</span></div>
                                        <div class="col-6"><span style="font-size: 70%;">{{convertTimeToUser($news->news_date)}}</span></div>
                                    </div>
                                </div>
                            </div> 
                        @endforeach
                    
                    </div>
                    {!! $allNews->appends([])->links('pagination::bootstrap-5') !!}
                </div>
            </div>
            <div class="col-lg-2 col-md-12 col-sm-12">
                @if (count($getCalendarDatas)>0)
                    <figure class="text-center">
                    <blockquote class="blockquote">
                        <u><p style="color: #da2714;">{{translator("Today Calendar")}}</p></u>
                    </blockquote>
                    </figure>
                  
                    <ul class="list-group">
                        @foreach ($getCalendarDatas as $newsItem)
                            @php
                                $date = \Carbon\Carbon::parse($newsItem->date);
                                env('APP_ENV')=='production'?$date = correctUserTime($date):'';
                            @endphp
                            @if ($date->isToday())
                                <li class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <span style="font-size: 110%;color:rgb(75, 31, 219);">{{$date->format('H:i')}}</span>
                                        <small><span class="badge rounded-pill" style="background-color:{{strtolower($newsItem->impact)=='low'?'grey':(strtolower($newsItem->impact)=='medium'?'#d67733':'red')}};">{{$newsItem->country}}</span></small>
                                    </div>
                                    <p class="mb-1" style="color: #4bc48b;">{{$newsItem->title}}</p>
                                    <small><span>{{$newsItem->previous}}</span>-><span>{{$newsItem->forecast}}</span> </small>
                                    
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    <div class="ads">
                        <p style="color: #4bc48b;text-align:center;">{{translator("Advertise")}}</p>
                        <a href="https://accounts.binance.com/register?ref=100995952&utm_medium=web_share_copy">
                            <img style="width: 100%;border-radius:5px;" src="{{url('images/ads/binance.jpeg')}}" alt="">
                        </a>
                    </div>
                @endif
                
            </div>
            
            
        </div>
        
    </div>

@endsection