@extends('voyager::master')
@section('content')
    <div class="container-fluid">
        <a href="/admin/forums-categories/create"><button class="btn btn-success float-right">Add New</button></a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Tag</th>
                <th>Desc</th>
                <th>Status</th>
                <th>Position</th>
                <th>Parent ID</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($forumsCats->isEmpty())
                <tr>
                    <td><p>No record</p></td> 
                </tr>       
            @endif
            @foreach ($forumsCats as $forums)
                <tr>
                    <td>{{$forums->title}}</td>
                    <td>{{$forums->tag}}</td>
                    <td>{{$forums->desc}}</td>
                    <td>{{\App\Models\ForumsCategory::ALL_STATUS[$forums->status]}}</td>
                    <td>{{$forums->position}}</td>
                    <td>{{$forums->parent_id}}</td>
                    <td>{{convertTimeToUser($forums->created_at)}}</td>
                    <td>
                        <i class="fa-regular fa-eye" style="color: rgb(52, 51, 51);font-size:120%;"></i>
                        <a href="/admin/forums-categories/edit/{{$forums->id}}"><i class="fa-regular fa-pen-to-square" style="color: rgb(52, 51, 51);font-size:120%;margin-left:10%;"></i></a>
                        <i class="fa-solid fa-trash" style="color: red;font-size:120%; margin-left:10%;" onclick="deleteItem({{$forums->id}})"></i>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>

    <script >
        function deleteItem(key){
            $("#confirmationModal .modal-body").html('<h4 style="color:red;">Are you sure to delete?</h4>');
            $("#confirmationOkModal").attr('href',"/admin/forums-categories/delete/"+key);

            const confirmationModal = $('#confirmationModal').modal();
            confirmationModal.show();
            const myModalEl = document.getElementById('confirmationModal');
            myModalEl.addEventListener('hidden.bs.modal', event => {
                $("#confirmationModal .modal-body").html('');
                confirmationModal.dispose();
            });
        }
    </script>
@endsection