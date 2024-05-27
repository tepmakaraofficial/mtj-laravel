@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection
@section('script')
@vite(['resources/js/forums.js'])
@endsection
@section('title','MTJ - Trading community')
@section('body')
    <style>
        .forumsDetailContainer{
            padding: 1%;
            min-height: 500px;
            overflow-y: scroll;
        }
        .forumsDetailContainer a{
            text-decoration: none;
        }
        .latestContainer h4{
            text-align: center;
        }
        .chatContainer ul li{
            border-radius: 7px;
        }
        .chatContainer ul{
            margin-bottom: 1%;
        }
        
        .dark .replyParent{
            margin-left: 5%;
            color: rgb(177, 180, 180);
        }
        .replyParent{
            margin-left: 5%;
            color: rgb(85, 109, 109);
        }
        .replyLabel{
            color: #1d8353;
        }
        .dark .replyLabel{
            color: #4bc48b;
        }

        .commentPostBody img{
            max-width: 100%;
            max-height: 500px;
            cursor:pointer;
        }

    </style>

    <div class="container-fluid forumsDetailContainer">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12">
                <div class="chatContainer" >
                    <h4 class="onTopic">{{$forumsCat->title}}</h4>
                    <p>{{$forumsCat->desc}}</p>
                    <hr>
                    @if (count($forumsChats)>0)
                        <ul class="list-group list-group-flush">                                        
                            @foreach ($forumsChats as $cItem)
                                <li class="list-group-item">
                                    {{userAvatar($cItem->user,true)}}
                                    <span> {{$cItem->user->name}} 
                                        @if (!empty($cItem->parent))
                                        <span> <span class="replyLabel">Replied to</span> {{$cItem->parent->user->name}}</span>
                                        @endif
                                        <br><span style="font-size: 60%;">{{convertTimeToUser($cItem->created_at)}}</span>
                                    </span>
                                    <div class="commentPostBody">{!!$cItem->post!!}</div>
                                    @if (!empty($cItem->parent))
                                        <div class="replyParent">
                                            {{userAvatar($cItem->parent->user,true)}}
                                            <div class="commentPostBody">{!!$cItem->parent->post!!}</div>
                                        </div>
                                    @endif
                                    <span style="float: right;"><i class="bi bi-reply fs-2 replyBtn" onclick="replyComment(this,{{$cItem->id}})" style="cursor:pointer;"></i></span>
                                </li>
                            @endforeach
                        </ul>
                        {!! $forumsChats->appends([])->links('pagination::bootstrap-5') !!}
                    @else
                        <p style="text-align: center;">No post yet</p>
                    @endif
                    @include('forums.comment-form')
                </div>
            </div>
            <div class="col">
                @include('forums.sidebar')
            </div>
        </div>
        
    </div>
@endsection