
<style>
    .notePostBody img{
            max-width: 100%;
            max-height: 500px;
            cursor:pointer;
    }
    .noteTitle{
        color:#0d5a36;
    }
    .dark .noteTitle{
        color:#5ec695;
    }
</style>
<div class="container-fluid mistakeNotes">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12"> 
            <div class="btn-group dropend">
                <i class="bi bi-funnel-fill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 150%;color:#2d9a67;"></i>
                <ul class="dropdown-menu" style="width:350px;">
                  <form action="" style="padding:7%;">
                    <div class="row g-1">
                        <div class="col">
                            <select type="text" name="level" class="form-control" id="">
                                <option value="all">{{translator('All')}}</option>
                                @foreach (\App\Models\MistakeNotes::ALL_LEVELS as $key=> $level)
                                    <option value="{{$key}}" {{$key==request()->get("level")?"selected":""}}>{{translator($level)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control mb-2" placeholder="Search any" value="{{request()->get("search")}}" name="search">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">{{translator('Search')}}</button>
                  </form>
                </ul>
            </div>
            <ol class="list-group list-group mb-2">
                @if ($mistakeNotes->isEmpty())
                    <p style="text-align: center;padding:10%;">No Data Found!</p>  
                @endif
                @foreach ($mistakeNotes as $mistakeNote)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                            <div class="fw-bold noteTitle" >{{$mistakeNote->title}}</div>
                                <div class="notePostBody"><span style="padding: 1%;">{!!$mistakeNote->desc!!}</span></div>
                            </div>
                            <span class="badge rounded-pill" style="background-color:{{$mistakeNote->level==1?"#2d9a67":($mistakeNote->level==2?"#a0890e":"#9c0303")}};">{{\App\Models\MistakeNotes::ALL_LEVELS[$mistakeNote->level]}}</span>
                            <i class="fa-solid fa-thumbtack" style="float: right;cursor:pointer;color:{{$mistakeNote->action==3?'2d9a67':'red'}};padding-left:2%;font-size:110%;" onclick="clickPin({{$mistakeNote->id}},this)"></i>
                        </div>
                        <div>
                            <span style="float: left;cursor:pointer;color:rgb(156, 153, 153);">{{convertTimeToUser($mistakeNote->created_at)}}</span>
                            
                            <a href="/trade/mistake-notes/view-edit/{{$mistakeNote->id}}"><i class="bi bi-pencil-square fs-5" style="float: right;cursor:pointer;"></i></a>
                        </div>
                    </li>
                @endforeach   
            </ol>
            {!! $mistakeNotes->appends([])->links('pagination::bootstrap-5') !!}
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form action="/trade/mistake-notes" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-6 col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-2">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{old("title")}}" placeholder="Your mistake or note title" required>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                        <label for="level">Level</label>
                        <select type="text" name="level" class="form-control" id="">
                            @foreach (\App\Models\MistakeNotes::ALL_LEVELS as $key=> $level)
                                <option value="{{$key}}" {{$key==old("desc")?"selected":""}}>{{translator($level)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <textarea name="desc" id="desc" style="height:200px;">{{old("desc")}}</textarea>
                    </div>
                </div>
                <div class="row justify-content-start" style="cursor: pointer;">
                    <div class="col-3"><button type="submit" class="btn btn-success mt-2"><i class="bi bi-plus-square-fill"></i> {{translator('Create')}}</button></div>
                </div>
            </form>
        </div>
    </div>
</div>