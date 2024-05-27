@extends('layout.master')
@section('top')
    @include('layout.top')
@endsection

@section('title', 'MTJ - Contact Us')
@section('body')
    <style>
       .container{
        padding: 5%;    
       }
    </style>
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success" role="alert">{{session()->get('message')}}</div>
        @else
            <p style="">
                We'd love to hear from you! If you have any questions, feedback, or suggestions, please don't hesitate to reach out to us.
                <br>Please also provide your info how we can contact you back.
            </p>
            <form action="/contact-us" method="post">
                {{ csrf_field() }}
                <textarea name="content" id="" cols="30" rows="10" class="form-control mb-2" placeholder="Please enter text here" required></textarea>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        @endif
        
    </div>
@endsection
