@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title','MTJ - Your Profile')
@section('body')
<style>
    .profielPanel{
        padding: 5%;
    }
    .profielPanel ul{
        border-radius: 7px;
    }

</style>
    @php
        $user = auth()->user();
        $isEdit = request()->get('isEdit');
    @endphp
    <div class="profielPanel">
        <div class="d-flex">
            <div class="p-2">{{userAvatar($user)}} </div>
            @if ($isEdit)
                
            @else
                <div class="p-2"><a href="/myprofile?isEdit=true"><i class="bi bi-pencil-square " style="font-size:130%;cursor:pointer;"></i></a></div>
            @endif
            
        </div>
        <hr class="mydivider">
        <ul class="list-group list-group-flush">
            @if ($isEdit)
                <li class="list-group-item">
                    <form action="/myprofile" method="post">
                        {{ csrf_field() }}
                        <label for="">Name</label>
                        <input style="width:20%;" type="text" class="form-control mb-1" name="name" value="{{$user->name}}">
                        <button class="btn btn-primary " type="submit">Save</button>
                    </form>
                </li>
            @else
                <li class="list-group-item">Name : {{$user->name}}</li>
            @endif
            
            <li class="list-group-item">Role : Trader</li>
            <li class="list-group-item">Email : {{str_replace('trader-','',$user->email)}}</li>
            <li class="list-group-item">Created At : {{$user->created_at}}</li>
        </ul>
    </div>
@endsection