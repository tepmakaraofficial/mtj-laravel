<style>
    .topOrderItem{
        padding: 2%;
    }
    .topOrderItem a{
        text-decoration: none;
    }
    .pendingItem{
        padding: 1%;
        color: #0281bd;
        font-size: 70%;
        /* background-color: rgb(5, 89, 110); */
    }

    .dark .pendingItem{
        padding: 1%;
        color:#0281bd;
        font-size: 70%;
        /* background-color: rgb(5, 89, 110); */
    }

    .lossItem{
        padding: 1%;
        color: #da2713;
        font-size: 70%;
    }
    .winItem{
        padding: 1%;
        color: #1a9935;
        font-size: 70%;
    }
    .topPair{
        padding: 3%;
    }
    .pendingOrder a{
        color: #0281bd;
    }
    .topLossOrder a{
        color: #da2713;
    }
    .topWinOrder a{
        color: #1a9935;
    }

    .topOrderWidget ol li{
        padding: 2%;
    }
    
</style>
<div class="topOrderWidget">
    <div class="dataContainer">
        @if (isset($pending) && isset($win) && isset($loss))
        <div>
            <ol class="list-group">
                <li class="list-group-item pendingOrder">
                    <div class="topOrderItem">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold holding"><span style="font-size: 100%;color:#0281bd;">{{translator('HOLDING')}} : {{$pending->count()}}</span></div>
                            </div>
                            <span ><i class="bi bi-emoji-smile" style="font-size:200%;color:#0281bd;"></i></span>
                        </div>
                        <div>
                            @foreach ($pending as $pending)
                                <span class="pendingItem">{{$pending->pair}} <sup>{{$pending->size}}</sup> </span>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="list-group-item topWinOrder">
                    <div class="topOrderItem">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold winOrder"><span style="font-size: 100%;color:#1a9935;">{{translator('TOP WIN')}}</span></div>
                            </div>
                            <span ><i class="bi bi-emoji-heart-eyes" style="font-size:200%;color:#1a9935;"></i></span>
                        </div>
                        <div>
                            @foreach ($win as $winItem)
                                <span class="winItem">+{{$winItem->profit_amount}}{{globalCcySymbol()}}</span>
                            @endforeach
                        </div>
                    </div>
                </li>
                <li class="list-group-item topLossOrder">
                    <div class="topOrderItem">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold winOrder"><span style="font-size: 100%;color:#da2713;">{{translator('TOP LOSS')}}</span></div>
                            </div>
                            <span ><i class="bi bi-emoji-surprise" style="font-size:200%;color:#da2713;"></i></span>
                        </div>
                        <div>
                            @foreach ($loss as $lossItem)
                                <span class="lossItem">-{{$lossItem->profit_amount}}{{globalCcySymbol()}}</span>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ol>
        </div>
        @endif
    </div>
</div>