@extends('voyager::master')
@section('content')
    <div class="container-fluid">
        
        <form action="/admin/motivations/add" method="post" class="form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-4">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="col-lg-4">
                    <label for="type">Type</label>
                    <select name="type" id="" class="form-control">
                        @foreach (\App\Models\Motivation::TYPES as $key=> $item)
                            <option value="{{$key}}">{{$item}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="content">Content</label>
                    <input type="text" name="content" class="form-control" required>
                </div>
                <div class="col-lg-4">
                    <label for="status">Type</label>
                    <select name="status" id="" class="form-control">
                        @foreach (\App\Models\Motivation::STATUS as $key=> $status)
                            <option value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <div class="row" style="padding: 5%;">
                        <div class="col-lg-3">
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection