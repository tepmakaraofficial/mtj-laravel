<style>
 
    .accountwidget .accountWidgetLabel{
        background-color: rgb(251, 250, 250);
        font-size: 90%;
        text-align: right;
        color:green;
    }

    .dark .accountwidget .accountWidgetLabel{
        background: none;
        font-size: 90%;
        text-align: right;
        color:#b3b5bd;
    }
    
    .accountwidget .dataContainer{
        max-height: 200px;
    }
    .accountwidget{
        padding: 2%;
    }

</style>
<div class="card accountwidget">
    <div class="accountWidgetLabel fw-bold"><i class="bi bi-wallet2"></i> Active Accounts</div>
    <div class="dataContainer">
        @if (isset($getAccounts) && $getAccounts->isNotEmpty() && isset($account) && !empty($account))
            <label style="color:#0281bd;font-weight:bold;">Your accounts</label>
            <select name="" id="dashboardAccount" class="form-control mb-1" onchange="dashboardAccountChange(this)">
                @foreach ($getAccounts as $accDetail)
                    <option value="{{$accDetail->id}}" {{request()->get('account')==$accDetail->id?"selected":""}}>{{$accDetail->name}}({{$accDetail->balance}}{{globalCcySymbol()}})</option>
                @endforeach
            </select>
            @php
                $availableBalance = $account->pnl<0?$account->balance-abs($account->pnl):$account->balance+$account->pnl;
                $availablePercent = round((($availableBalance*100)/$account->balance),2);
            @endphp
            <div class="container" style="padding: 1%;">
                <div class="row row-cols-2 justify-content-around">
                    <div class="col">
                        {{-- <a href="#" style="text-decoration: none;color:#0281bd;font-size:90%;"><span style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{$account->trading_type}}</span></a> --}}
                        <div class="row">
                            <div class="col-12">
                                <span style="font-size: 100%;color:#3ca876;">Init : {{$account->balance}}{{globalCcySymbol()}} </span><span style="color:#0281bd;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{$account->trading_type}}</span>
                            </div>
                            <div class="col-12">
                                <span style="font-size: 120%;color:#3ca876;">Total : {{$availableBalance}}{{globalCcySymbol()}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <label style="font-weight:bold;color:#0281bd;">PNL : <span style="color:{{$account->pnl>=0?'#3ca876':'#da2713'}};">{{$account->pnl>=0?'+':''}}{{$account->pnl}}{{globalCcySymbol()}}</span></label>
                        <br><label style="font-weight:bold;color:#0281bd;">COUNT : {{$account->count_order}}</label>
                    </div>
                </div>
                <div class="progress mt-1" style="width:100%;">
                    <div class="progress-bar" role="progressbar" style="width: {{$availablePercent}}%;background-color:{{$availablePercent<50?"#ba3c3c":"#4f8546"}};color:#f3f7f2;" aria-valuenow="{{$availablePercent}}" aria-valuemin="0" aria-valuemax="100">{{$availablePercent}}%</div>
                </div>
            </div>
        @endif
        
    </div>
</div>