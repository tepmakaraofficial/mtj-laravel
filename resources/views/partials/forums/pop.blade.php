<style>

    .inPop{
        /* font-size:70%; */
    }
    .inPopChild{
        padding: 2%;
    }
    .dark .popItem{
        margin: 0.5%;
        padding: 1%;
        background-color: #212529;
        border-radius: 5px;
    }

    .popItem{
        margin: 0.5%;
        padding: 1%;
        background-color: #ebebeb;
        border-radius: 5px;
    }
   
</style>
<div class="inPop">
    <div class="inPopChild">
        @if (count($forumsPop)>0)
            <div class="d-flex flex-wrap">
                @foreach ($forumsPop as $cItem)
                <div class="popItem"><span><a href="/forums/{{$cItem->id}}">{{$cItem->title}}</a></span></div>
                @endforeach
            </div>
        @else
            <div style="text-align: center;">{{translator("No Record")}}</div>
        @endif
    </div>
</div>