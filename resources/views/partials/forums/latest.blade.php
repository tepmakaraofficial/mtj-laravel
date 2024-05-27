<style>

    .inlatestContainer{
        font-size:70%;
    }
    .inlatestContainerChild{
        padding: 2%;
    }

    .dark .latestItem{
        background-color: #212529;
        border-radius: 5px;
        padding: 2%;
    }
    .latestItem{
        background-color: #e3e3e3;
        border-radius: 5px;
        padding: 2%;
    }
    .postBody{
        margin-top: 2%;
    }
    
</style>
<div class="inlatestContainer">
    <div class="row g-1 inlatestContainerChild">
        @if (count($forumsLatests)>0)
            @foreach ($forumsLatests as $cItem)
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="latestItem">
                        <h6>On Topic <a href="/forums/{{$cItem->cat->id}}"><span class="onTopic">{{$cItem->cat->title}}</span></a></h6>
                        {{-- {{userAvatar($cItem->user,true)}} --}}
                        <span> {{$cItem->user->name}} 
                            @if (!empty($cItem->parent))
                                <span> <span class="replyLabel">Replied to</span> {{$cItem->parent->user->name}}</span>
                            @endif
                        </span>
                        @php
                            $summaryPost = strip_tags($cItem->post);
                            $summaryPost = str_replace("&nbsp;","",$summaryPost);
                            if(empty($summaryPost)){
                                $summaryPost = 'Post an image';
                            }
                        @endphp
                        <div class="postBody">{{$summaryPost}}</div>
                    </div>
                    
                </div>
            @endforeach
        @else
                <div class="col" style="text-align: center;">{{translator("No Record")}}</div>
        @endif
        
    </div>
</div>