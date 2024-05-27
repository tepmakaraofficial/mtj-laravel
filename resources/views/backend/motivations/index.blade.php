@extends('voyager::master')
@section('content')
    <div class="container-fluid">
        <a href="/admin/motivations/create"><button class="btn btn-success float-right">Add New</button></a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Type</th>
                <th>Like</th>
                <th>Content</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($motivations->isEmpty())
                <tr>
                    <td><p>No record</p></td> 
                </tr>       
            @endif
            @foreach ($motivations as $motivation)
                <tr>
                    <td>{{$motivation->title}}</td>
                    <td>{{\App\Models\Motivation::TYPES[$motivation->type]}}</td>
                    <td>{{$motivation->like}}</td>
                    <td>{{$motivation->content}}</td>
                    <td>{{\App\Models\Motivation::STATUS[$motivation->status]}}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection