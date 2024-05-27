<style>
  
    /* .settingPlatform,.settingStrategy,.settingPair,.settingAccount{
        background-color: #fcfcfc;
        border-radius: 10px;
    }
    .dark .settingPlatform,.dark .settingStrategy,.dark .settingPair,.dark .settingAccount{
        background-color: #212529;
        border-radius: 10px;
    } */
    .settingPlatformChild,.settingStrategyChild,.settingPairChild,.settingAccountChild{
        padding: 2%;
        cursor: pointer;
    }
    .settingWidgets .list-group{
        max-height: 700px;
        overflow-y:scroll;
    }
    .scrolling-wrapper .card{
        min-width: 50%;
        padding:3%;
        border-radius:15px;
    }
    .scrolling-wrapper {
        -webkit-overflow-scrolling: touch;
    }
    .widgetTitle{
        color: #034303;
    }

    .dark .widgetTitle{
        color: #b3b5bd;
    }

    .dark .subLabel{
        color:#b3b5bd;
        border: none;
        outline: none; 
        max-width:90%;
        text-overflow:ellipsis;
    }
    .subLabel{
        color:#3a3b3d;
        border: none;
        outline: none; 
        max-width:90%;
        text-overflow:ellipsis;
    }
    .accTitle{
        border: none;
        outline: none;
        max-width:100%;
        text-overflow:ellipsis;
        color:#0281bd;
    }
    .dark .accTitle{
        border: none;
        outline: none;
        max-width:100%;
        text-overflow:ellipsis;
        color:#4eaad5;
    }
    .disabledAcc{
        background-color: #c6c6c6;
    }
    .dark .disabledAcc{
        background-color: #69232c;
    }

</style>
    <div class="container-fluid settingWidgets">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="tradingTypeContainer">
                    @include('partials.setting-widgets.trading-type')
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                
            </div>
        </div>
        <div class="row g-1 justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 settingAccount mb-1">
                <div class="settingAccountChild">
                    <h5 class="widgetTitle">{{translator("Manage your accounts")}}</h5>
                    <div class="row g-1">
                        <div class="col-6 col-lg-8 col-md-4 col-sm-12 mb-1">
                            <input type="text" class="form-control" id="acc-name" placeholder="{{translator("100$ acc small profit consistency.")}}">
                        </div>
                        <div class="col-6 col-lg-4 col-md-4 col-sm-12 mb-1">
                            <input  pattern="[0-9]*[.]?[0-9]*" type="text" class="form-control number-only" id="acc-balance" placeholder="0">
                        </div>
                        <div class="col-6 col-lg-4 col-md-4 col-sm-12 mb-1">
                            {{-- <section class="form-control" id="acc-ccy">
                                <option value="USD">USD</option>
                            </section> --}}
                            <select id="acc-ccy" class="form-control">
                                <option value="{{globalCcySymbol(true)}}">Currency {{globalCcySymbol()}}</option>
                            </select>
                        </div>
                        <div class="col-6 col-lg-4 col-md-4 col-sm-6 mb-1">
                            <select name="" id="acc-type" class="form-control">
                                @foreach (\App\Models\UserSetting::getTradingType($getUserSetting)->pluck('value')->toArray() as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-lg-4 col-md-4 col-sm-6 mb-1">
                            <select class="form-control" name="" id="acc-status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                        </div>
                        <input type="hidden" name="" id="acc-id">
                        <div class="col-6 col-lg-6 col-md-6 col-sm-12 mb-1">
                            <textarea name="" id="acc-remark" class="form-control" placeholder="Account remark"></textarea>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-success float-right" onclick="saveAccountrecord(this)" style="margin: 8%;">Save</button>
                        </div>
                    </div>
                    
                    <hr class="mydivider">
                    <div class="scrolling-wrapper">
                        <ul class="list-group list-group-horizontal position-relative overflow-auto w-100">
                            @foreach ($getAccounts as $key => $account)
                                <div class="{{$account->status!=1?'disabledAcc':''}} card accountItem{{$account->id}}" style="cursor:pointer;" >
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                        <div class="fw-bold"><span id="view-acc-name" val="{{$account->name}}" class="accTitle" >{{$account->name}}</span></div>
                                            <h5 class="subLabel">{{number_format($account->balance, 2, '.', '')}}{{globalCcySymbol()}}</h5>
                                            <p style="font-size:70%;" >{{$account->remark}}</p>
                                        </div>
                                        <span class="badge rounded-pill bg-primary" ><span>{{$account->trading_type}}</span></span>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-2">
                                                <i class="fa fa-trash" onclick="deleteAccountItem({{$account->id}})" aria-hidden="true" style="color: #da2713;font-size:15px;"></i>
                                            </div>
                                            <div class="col-2">
                                                <i class="fa fa-pencil-square" onclick="editAccountItem({{$account->id}})" aria-hidden="true" style="color: rgb(213, 142, 11);font-size:20px;"></i>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <span style="font-size:50%;">Created : {{convertTimeToUser($account->created_at)}}</span>
                                    <span style="font-size:50%;">Updated : {{convertTimeToUser($account->updated_at)}}</span>
                                    
                                </div>
                            @endforeach
                        </ul>
                     
                    </div>
                    <div class="total">
                        <h6 style="padding: 1%;color:#3ca876;text-align:right;"><i class="fa fa-list-ol" aria-hidden="true"></i> : {{count($getAccounts)}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 settingPlatform mb-2">
                <div class="settingPlatformChild">
                    <h5 class="widgetTitle">{{translator("Manage your platform/market")}}</h5>
                    <div class="row g-2">
                        <div class="col-7">
                            <input type="text" class="form-control" id="platform" placeholder="{{translator("EX: MT4 or Binance")}}">
                        </div>
                        <div class="col">
                            <button class="btn btn-success" onclick="savePlatformrecord(this)"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <hr class="mydivider">
                    <ul class="list-group platformSortable">
                    @php
                        $getPlatform = \App\Models\UserSetting::getPlatform($getUserSetting);
                    @endphp
                    @foreach ($getPlatform as $key => $platformItem)
                        <li class="list-group-item platformItem{{$platformItem->id}}" sort-position-id="{{$platformItem->id}}">
                            <div class="row">
                                <div class="col"><i class="fa fa-sort" aria-hidden="true"></i></div>
                                <div class="col"><input type="text" value="{{$platformItem->value}}" style="border: none;outline: none;max-width:90%;text-overflow:ellipsis;" disabled></div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-2">
                                            <i class="fa fa-pencil-square" onclick="editPlatformItem({{$platformItem->id}})" aria-hidden="true" style="color: rgb(213, 142, 11);font-size:20px;"></i>
                                        </div>
                                        <div class="col-2 platformItemSaveContainer">
                                            <i class="fa fa-trash" onclick="deletePlatformItem({{$platformItem->id}})" aria-hidden="true" style="color: #da2713;font-size:15px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                    <div class="total">
                        <h6 style="padding: 1%;color:#3ca876;text-align:right;"><i class="fa fa-list-ol" aria-hidden="true"></i> : {{count($getPlatform)}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 settingPair mb-2">
                <div class="settingPairChild">
                    <h5 class="widgetTitle">{{translator("Manage your trading pairs")}}</h5>
                    <div class="row g-2">
                        <div class="col-5">
                            <input type="text" class="form-control" id="pair" placeholder="{{translator("EX: XAU/USD or BTC/USDT")}}">
                        </div>
                        <div class="col">
                            <select name="" id="pair-type" class="form-control">
                                @foreach (\App\Models\UserSetting::getTradingType($getUserSetting)->pluck('value')->toArray() as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <button class="btn btn-success" onclick="savePairrecord(this)">{{translator("Add")}}</button>
                        </div>
                    </div>
                    <hr class="mydivider">
                    @php
                        $getPair = \App\Models\UserSetting::getPair($getUserSetting);
                    @endphp
                    <div class="row">
                        @foreach (\App\Models\UserSetting::getTradingType($getUserSetting)->pluck('value')->toArray() as $item)
                            @php
                                $filterPair = $getPair->where('key',"PAIR_".$item);
                            @endphp
                            <div class="col {{$item}}">
                                <label style="color:#3ca876;font-weight:bold;">{{$item}}</label>
                                <ul class="list-group pairSortable">
                                    
                                    @foreach ($filterPair as $key => $pairItem)
                                        <li class="list-group-item pairItem{{$pairItem->id}}" sort-position-id="{{$pairItem->id}}">
                                            <div class="row">
                                                <div class="col-1"><i class="fa fa-sort" aria-hidden="true"></i></div>
                                                <div class="col-7"><input type="text" value="{{$pairItem->value}}" class="subLabel"  disabled></div>
                                                <div class="col">
                                                    <div class="row justify-content-center">
                                                        <div class="col-2 ">
                                                            <i class="fa fa-pencil-square" onclick="editPairItem({{$pairItem->id}})" aria-hidden="true" style="color: rgb(213, 142, 11);font-size:20px;"></i>
                                                        </div>
                                                        <div class="col-2  pairItemSaveContainer">
                                                            <i class="fa fa-trash" onclick="deletePairItem({{$pairItem->id}})" aria-hidden="true" style="color: #da2713;font-size:15px;"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="total">
                                    <h6 style="padding: 1%;color:#3ca876;text-align:right;"><i class="fa fa-list-ol" aria-hidden="true"></i> : {{count($filterPair)}}</h6>
                                </div>
                                <hr>
                            </div>
                            
                        @endforeach
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 settingStrategy mb-2">
                <div class="settingStrategyChild">
                    <h5 class="widgetTitle">{{translator("Manage your strategies")}}</h5>
                    <div class="row g-2">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <input type="text" class="form-control" id="strategy" placeholder="{{translator("EX: Smart Money Concept")}}">
                        </div>
                        <div class="col">
                            <button class="btn btn-success" onclick="saveStrategyrecord(this)">{{translator("Add")}}</button>
                        </div>
                    </div>
                    <hr class="mydivider">
                    @php
                        $getStrategy = \App\Models\UserSetting::getStrategy($getUserSetting);
                    @endphp
                    <ul class="list-group strategySortable">
                    @foreach ($getStrategy as $key => $strategyItem)
                        <li class="list-group-item strategyItem{{$strategyItem->id}}" sort-position-id="{{$strategyItem->id}}">
                            <div class="row">
                                <div class="col"><i class="fa fa-sort" aria-hidden="true"></i></div>
                                <div class="col"><input type="text" value="{{$strategyItem->value}}" style="border: none;outline: none; max-width:90%;text-overflow:ellipsis;" disabled></div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-2">
                                            <i class="fa fa-pencil-square" onclick="editStrategyItem({{$strategyItem->id}})" aria-hidden="true" style="color: rgb(213, 142, 11);font-size:20px;"></i>
                                        </div>
                                        <div class="col-2 strategyItemSaveContainer">
                                            <i class="fa fa-trash" onclick="deleteStrategyItem({{$strategyItem->id}})" aria-hidden="true" style="color: #da2713;font-size:15px;"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </ul>
                    <div class="total">
                        <h6 style="padding: 1%;color:#3ca876;text-align:right;"><i class="fa fa-list-ol" aria-hidden="true"></i> : {{count($getStrategy)}}</h6>
                    </div>
                </div>
            </div>
            
        </div>  
    </div>