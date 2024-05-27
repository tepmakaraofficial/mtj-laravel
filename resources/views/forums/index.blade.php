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
        .forumsContainer{
            padding: 1%;
        }
        .forumsContainer a{
            text-decoration: none;
        }
        .listMain ul{
            border-radius: 7px !important;
        }
        .searchInput{
            /* border-bottom: 0;
            border-radius: 5px 5px 0px 5px; */
        }
        
    </style>
    <div class="container-fluid forumsContainer">
        <div class="row g-1">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <div class="listMain">
                    <form action="/forums">
                        <div class="row g-1">
                                <div class="col-4">
                                    <input type="text" class="form-control searchInput" name="searchInput" value="{{request()->get('searchInput')}}" placeholder="search topic">
                                </div>
                                <div class="col"><button type="submit" class="btn"><i class="bi bi-search" style="font-size: 125%;"></i></button></div>
                        </div>
                    </form>
                    <ul class="list-group list-group-flush">
                        @foreach ($forumsCats->whereNull('parent_id') as $item)
                         <li class="list-group-item">
                             <a class="" data-bs-toggle="collapse" href="#collapse{{$item->id}}" role="button" aria-expanded="false" aria-controls="collapse{{$item->id}}">{{$item->title}}</a>
                             <p>{{$item->desc}}</p>
                             <div style="margin-left: 3%;" class="collapse" id="collapse{{$item->id}}">
                                 <ul class="list-group list-group-flush">
                                     
                                     @foreach ($forumsCats->where('parent_id',$item->id) as $cItem)
                                         <li class="list-group-item">    
                                             <a href="/forums/{{$cItem->id}}">{{$cItem->title}}</a>
                                             <p>{{$cItem->desc}}</p>
                                         </li>
                                     @endforeach
                                 </ul>
                             </div>
                         </li>
                        @endforeach
                     </ul>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
               @include('forums.sidebar')
            </div>
        </div>
    </div>
@endsection