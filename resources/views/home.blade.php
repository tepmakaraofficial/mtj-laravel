@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title','MTJ is your trademate')
@section('body')
    @section('sidebar-content')
        
        @if($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
        @endif
        @if (request()->getPathInfo()=='/trade/create-form')
            <div id="pin-message"></div>
            @include('partials.trade-form')
            @section('script')
                @vite(['resources/js/trade.js'])
            @endsection
        @elseif (strpos(request()->getPathInfo(),'/trade/edit-form')!==false)
            @include('partials.trade-form-edit')
        @elseif (strpos(request()->getPathInfo(),'/trade/detail')!==false)
            @include('partials.trade-detail')
        @elseif (request()->getPathInfo()=='/trade/list')
            @include('partials.trade-list')
        @elseif (request()->getPathInfo()=='/trade/mistake-notes')
            @include('partials.mistake-notes')
            @section('script')
                @vite(['resources/js/mistakeNote.js'])
            @endsection
        @elseif (strpos(request()->getPathInfo(),'/trade/mistake-notes/')!==false)
            @include('partials.mistake-notes-view-edit')
            @section('script')
                @vite(['resources/js/mistakeNote.js'])
            @endsection
        @elseif (request()->getPathInfo()=='/trade/setting')
            @include('partials.setting')
            @section('script')
                @vite(['resources/js/setting.js'])
            @endsection
        @else
            @include('partials.dashboard')
            @section('script')
                @vite(['resources/js/dashboard.js'])
            @endsection
        @endif
        
    @stop
    <script type="module">
        $("#pin-message").ready(function(){
            $.get("/pin-message")
            .done(function( data ) {
                // console.log(data);
                $("#pin-message").html(data);
            }).fail(function(error){
                console.log(error.responseJSON);
                alert(error.responseJSON.message);
            });
        });
    </script>
@stop