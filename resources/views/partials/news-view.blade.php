<style>
    .newsViewContainer img{
        border: 1px #b3b5bd solid;
        border-radius: 7px;
        width: 100%;
    }
 
</style>
<div class="container-fluid newsViewContainer">
    
    <div class="container">
        <div class="row justify-content-between">
            <div class="col">
                <img src="{{$news->image}}" />
            </div>
            <div class="col">
                <div><h6 style="padding-top:0.7%;">{{$news->headline}}</h6></div>
                <span style="color:#4bc48b;font-size: 100%;font-weight:bold;">{{$news->source}}: {{ucwords($news->category)}}</span>
                <span style="font-size: 100%;">{{convertTimeToUser($news->news_date)}}</span>
                <hr>
                <div><p class="summary">{{strip_tags($news->summary)}}</p></div>
                <a href="{{$news->url}}" target="_blank" class="btn btn-success">{{translator("Read More")}}</a>
            </div>
        </div>
   
    </div><br>
    <button type="button" class="btn btn-danger float-end" data-bs-dismiss="modal">{{translator("Close")}}</button>
</div>