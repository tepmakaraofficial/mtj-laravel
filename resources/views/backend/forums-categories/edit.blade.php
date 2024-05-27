@extends('voyager::master')
@section('content')
    <div class="container-fluid">
        
        <form action="/admin/forums-categories/save/{{$getCat->id}}" method="post" class="form">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-4">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" value="{{old('title')??$getCat->title}}" required>
                </div>
                <div class="col-lg-4">
                    <label for="tag">Tag</label>
                    <input type="text" name="tag" class="form-control" value="{{old('tag')??$getCat->tag}}">
                </div>
                <div class="col-lg-4">
                    <label for="desc">Desc</label>
                    <textarea type="text" name="desc" class="form-control" >{{old('desc')??$getCat->desc}}</textarea>
                </div>
                <div class="col-lg-4">
                    <label for="position">Position</label>
                    <input type="text" name="position" class="form-control" value="{{old('position')??$getCat->position}}">
                </div>
                <div class="col-lg-4">
                    <label for="parent_id">Parent ID</label>
                    <select name="parent_id" class="form-control">
                        <option value="">None</option>
                        @foreach (\App\Models\ForumsCategory::where('status',1)->get() as $parent)
                            <option value="{{$parent->id}}" {{(old('parent_id')??$getCat->parent_id)==$parent->id?'selected':'' }}>{{$parent->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="status">Status</label>
                    <select name="status" id="" class="form-control">
                        @foreach (\App\Models\ForumsCategory::ALL_STATUS as $key=> $status)
                            <option value="{{$key}}" {{(old('status')??$getCat->status)==$key?"selected":''}}>{{$status}}</option>
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