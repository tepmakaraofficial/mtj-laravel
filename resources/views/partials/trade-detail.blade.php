<style>
    .tradeDetial label{
        color: #034303;
    }
    .dark .tradeDetial label{
        color: #3ca876;
    }
    
    .tradeDetial .profit{
        font-size: 300%;
    }
    .tradeDetial{
        padding: 3%;
    }
    sup{
        color: blue;
    }
    .dark sup{
        color: #c2c2c2;
    }
</style>
<div class="container">
    <div class="row tradeDetial justify-content-start">
        <div class="row">
            <div class="col-4 profit">
                <label style="color: rgb(35, 126, 192);">PNL <i class="{{$trade->profit_status==1?"bi bi-emoji-heart-eyes":($trade->profit_status==0?"bi bi-emoji-sunglasses":"bi bi-emoji-surprise")}}" style="color: #0281bd;"></i></label>
                <p>
                    @if ($trade->profit_status==0)
                        <div class="spinner-grow text-warning" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    @elseif($trade->profit_status==1)
                        <span style="color:green;font-weight:bold;">+{{$trade->profit_amount}}{{$trade->profit_type==2?"%":globalCcySymbol()}}</span>
                    @else
                        <span style="color:red;font-weight:bold;">-{{$trade->profit_amount}}{{$trade->profit_type==2?"%":globalCcySymbol()}}</span>
                    @endif
                </p>
            </div>
            
        </div>
        <hr class="mydivider">
        <div class="col-4">
            <label >PAIR</label>
            <p>
                {{$trade->pair}} <sup style="color:{{$trade->position=="Buy"?"#3ca876":"red"}};">{{$trade->position=="Buy"?"Buy":"Sell"}}</sup>
            </p>
        </div>
        <div class="col-4">
            <label >{{translator('Swap+Commission Fee')}}</label>
            <p>
                {{$trade->fee_amount}}{{globalCcySymbol()}}</sup>
            </p>
        </div>
        <div class="col-4">
            <label >TRADING TYPE</label>
            <p>{{$trade->trading_type}}</p>
        </div>
        <div class="col-4">
            <label >PLATFORM</label>
            <p>{{$trade->platform}}</p>
        </div>
        <div class="col-4" title="{{$trade->account->name}}">
            <label>ACCOUNT</label>
            <p><a href="#" style="text-decoration: none;color:#0281bd;">{{$trade->account->name}}<sup >{{$trade->account->balance}}{{globalCcySymbol()}}</sup></a></p>
        </div>
        <div class="col-4">
            <label >OPEN PRICE</label>
            <p>{{$trade->open_price}}<sup >{{$trade->displaySizeByType($trade->size,$trade->trading_type)}}</sup></p>
        </div>
        <div class="col-4">
            <label >EXECUTION</label>
            <p>{{$trade->entry_type}}</p>
        </div>
        <div class="col-4">
            <label >CLOSING</label>
            @if (empty($trade->close_price))
                <p>Not Set <span style="color: red;">*</span></p>
            @endif
            <p>{{$trade->close_position}}<sup>{{$trade->close_price}}</sup></p>
        </div>
        <div class="col-4">
            <label >STRATEGY&EMOTION</label>
            <p>{{$trade->strategy}}<sup>{{$trade::getAllEmotions()[$trade->emotion_status]}}</sup></p>
        </div>
        <div class="col-4">
            <label >SESSION</label>
            <p>{{$trade->session}}</p>
        </div>
        <div class="col-4">
            <label >REMARK</label>
            <p>{{$trade->remark}}</p>
        </div>
        <div class="col-4">
            <label >OPEN DATETIME</label>
            <p>{{convertTimeToUser($trade->created_at)}}</p>
        </div>
        <div class="col-4">
            <label >UPDATED AT</label>
            <p>{{convertTimeToUser($trade->updated_at)}}</p>
        </div>
        <div>
            
            <div class="row">
                <div class="col">
                    <div class="dropup">
                        <button type="button" class="btn btn-danger" data-bs-toggle="dropdown" aria-expanded="false">{{translator('Delete')}}</button>
                        <div class="dropdown-menu">
                            <div class="row justify-content-center" style="padding: 5%;">
                                <div class="col-11"><h5 class="alert-danger">{{translator("Are you sure to delete this order?")}}</h5></div>
                                <div class="col-6">
                                    <a class="btn btn-primary" href="#" style="margin-right: 10%;">{{translator("No")}}</a>
                                    <a class="btn btn-danger" href="/trade/delete/{{$trade->id}}">{{translator("Yes")}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    @if ($isModal)
                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">{{translator('Close')}}</button>
                    @endif
                    <a href="/trade/edit-form/{{$trade->id}}">
                        <button type="button" class="btn btn-primary float-end" style="margin-right:2%;" >{{translator(empty($trade->close_price)?'Click Here To Complete Order':'Edit')}}</button>
                    </a>
                </div> 
            </div>
            
        </div>
    </div>
</div>