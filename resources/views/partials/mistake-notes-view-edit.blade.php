<style>
    .notePostBody img{
            max-width: 100%;
            max-height: 400px;
            cursor:pointer;
    }
</style>
<div class="container-fluid mistakeNotes">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12"> 
            <div class="d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold" style="color: #4bc48b;">{{$mistakeNote->title}}</div>
                    <div class="notePostBody"><span style="padding: 1%;">{!!$mistakeNote->desc!!}</span></div>
                </div>
                <span class="badge rounded-pill" style="background-color:{{$mistakeNote->level==1?"#4bc48b":($mistakeNote->level==2?"#c7a408":"#9c0303")}};">{{\App\Models\MistakeNotes::ALL_LEVELS[$mistakeNote->level]}}</span>
            </div>
            <div class="row justify-content-end">
                <div class="col-1"><a href="/trade/mistake-notes" title="Back to list"><i class="bi bi-list-ol fs-5" style="float: right;cursor:pointer;"></i></a></div>
                <div class="col-2">
                    <div class="dropdown">
                        <a type="button" title="Delete this record" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-trash fs-5" style="float: right;cursor:pointer; color:red;"></i></a>
                        <div class="dropdown-menu" style="width: 400%;">
                            <div class="row justify-content-center" style="padding: 5%;">
                                <div class="col-11 mb-3"><h5 class="alert-danger" style="text-align: center;">{{translator("Are you sure to delete?")}}</h5></div>
                                <div class="col-7">
                                    <a class="btn btn-primary" href="#" style="margin-right: 10%;">{{translator("No")}}</a>
                                    <a class="btn btn-danger" href="/trade/mistake-notes/delete/{{$mistakeNote->id}}">{{translator("Yes")}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <form action="/trade/mistake-notes/{{$mistakeNote->id}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-6 col-lg-8 col-md-8 col-sm-12 col-xs-12 mb-2">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{old("title")??$mistakeNote->title}}" placeholder="Your mistake or note title" required>
                    </div>
                    <div class="col-6 col-lg-4 col-md-4 col-sm-12 col-xs-12 mb-2">
                        <label for="level">Level</label>
                        <select type="text" name="level" class="form-control" id="">
                            @foreach (\App\Models\MistakeNotes::ALL_LEVELS as $key=> $level)
                                <option value="{{$key}}" {{$key==(old("level")??$mistakeNote->level)?"selected":""}}>{{translator($level)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <textarea name="desc" id="desc" style="height:200px;">{{old("desc")??$mistakeNote->desc}}</textarea>
                    </div>
                </div>
                <div class="row justify-content-start" style="cursor: pointer;">
                    <div class="col-3"><button type="submit" class="btn btn-success mt-2"><i class="bi bi-plus-square-fill"></i> {{translator('Update')}}</button></div>
                </div>
            </form>
        </div>
    </div>
</div>