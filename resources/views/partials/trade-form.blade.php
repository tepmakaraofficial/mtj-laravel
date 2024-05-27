<style>
     .header-label{
        color: #034303 !important;
        text-align: center;
        background-color: rgb(227, 234, 228);
        margin: 10px;
    }
    .dark .header-label{
        color: #dadbdf !important;
        text-align: center;
        background-color: #363636;
        margin: 10px;
    }
    #tradeForm .row{
        padding: 0.4%;
    }
    .floating-container {
        position: fixed;
        width: 20%;
        height: 100px;
        bottom: 0;
        right: 0;
        margin: 160px 25px;
    }
    .floating-container .floating-button {
        position: absolute;
        /* width: 65px;
        height: 65px; */
        bottom: 0;
        border-radius: 10px;
        left: 0;
        right: 0;
        margin: auto;
        color: white;
        line-height: 65px;
        text-align: center;
        /* font-size: 23px; */
        z-index: 100;
        box-shadow: 0 10px 25px -5px rgb(175 184 188 / 30%);
        cursor: pointer;
        -webkit-transition: all 0.3s;
        transition: all 0.3s;
    }
    .dark .btn-success{
        background-color: #5b9c4b;
    }
    .dark .btn-danger{
        background-color: #cc2c42;
    }
</style>
<form action="/trade/create" method="post" id="tradeForm">  
    {{ csrf_field() }}
    <h4 class="header-label">{{translator('Opening')}} <span style="color: red;">*</span></h4>
    <div class="row g-1">
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="emotion-status">{{translator('Emotion Status')}} <span style="color: red;">*</span></label>
            <select name="emotion-status" id="" class="form-control">
                @foreach (\App\Models\Trade::getAllEmotions() as $key => $emotion)
                    <option value="{{$key}}" {{old('emotion-status')==$key?"selected":""}}>{{$emotion}}</option>
                @endforeach
                
            </select>
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="platform">{{translator('Platform/Market')}} <span style="color: red;">*</span></label>
            @php
                $getPlatform = \App\Models\UserSetting::getPlatform($getUserSetting);
            @endphp
            @if (count($getPlatform)>0)
                <select name="platform" class="form-control">
                    @foreach ($getPlatform as $item)
                        <option value="{{$item->value}}" {{(old("platform")??($lastTrade->platform??null))==$item->value?"selected":''}}>{{$item->value}}</option>
                    @endforeach
                </select>
            @else
                <input type="text" class="form-control" value="{{old("platform")}}" name="platform" placeholder="{{translator('Platform/Market')}}" required>
            @endif
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="account">{{translator('Account')}} <span style="color: red;">*</span></label>
            @if (count($getAccounts)>0)
                <select name="account" id="" class="form-control">
                    @foreach ($getAccounts as $account)
                        <option value="{{$account->id}}" {{(old('account')??($lastTrade->account->id??null))==$account->id?"selected":""}}>{{$account->name}}({{$account->balance}}{{globalCcySymbol()}})</option>
                    @endforeach
                </select>
            @else
                <select name="account" id="" class="form-control">
                    <option value="">{{translator("No account yet!")}}</option>
                </select>
            @endif
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12" id="tradingType">
            <label for="trading-type">{{translator('Trading Type')}} <span style="color: red;">*</span></label>
            <select name="trading-type" id="" class="form-control">
                @foreach (\App\Models\UserSetting::getTradingType($getUserSetting) as $key=> $tdType)
                    <option value="{{$tdType->value}}" {{(old('trading-type')??($lastTrade->trading_type??null))==$tdType->value?"selected":""}}>{{$tdType->value}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row g-1">
        
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="strategy">{{translator('Strategy')}} <span style="color: red;">*</span></label>
            @php
                $getStrategy = \App\Models\UserSetting::getStrategy($getUserSetting);
            @endphp
            @if (count($getStrategy)>0)
                <select name="strategy" class="form-control">
                    @foreach ($getStrategy as $item)
                        <option value="{{$item->value}}" {{(old("strategy")??($lastTrade->strategy??null))==$item->value?"selected":''}}>{{$item->value}}</option>
                    @endforeach
                </select>
            @else
                <input type="text" class="form-control" value="{{old("strategy")}}" name="strategy" placeholder="{{translator('Ex: SMC')}}">
            @endif
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12" id="selectPair">
            <label for="pair">{{translator('Pair')}} <span style="color: red;">*</span></label>
            @php
                $getPair = \App\Models\UserSetting::getPair($getUserSetting);
                $defTradingType = \App\Models\UserSetting::getTradingType($getUserSetting)->pluck('value')->toArray()[0]??null;
                $currentTradingType = (old('trading-type')??($lastTrade->trading_type??null))??$defTradingType;
                $getPair = $getPair->where('key',"PAIR_".$currentTradingType);
                
            @endphp
            @if (true)
                <select name="pair" class="form-control">
                    @foreach ($getPair as $item)
                        <option value="{{$item->value}}" {{(old("pair")??($lastTrade->pair??null))==$item->value?"selected":''}}>{{$item->value}}</option>
                    @endforeach
                </select>
            @else
                <input type="text" class="form-control" value="{{old("pair")}}" name="pair" placeholder="{{translator('Ex:XAU/USD')}}" required> 
            @endif
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="size">{{translator('Margin Size/Lot Size')}} <span style="color: red;">*</span></label>
            <input type="text"  pattern="[0-9]*[.]?[0-9]*" class="form-control number-only" value="{{old("size")??($lastTrade->size??null)}}" name="size" placeholder="{{translator('EX: 18 USDT or 0.01 lot')}}" required>
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="position">{{translator('Position')}} <span style="color: red;">*</span></label>
            <select name="position" id="" class="form-control">
                @foreach (\App\Models\Trade::POSITIONS as $key => $position)
                    <option value="{{$key}}" {{(old('position')??($lastTrade->position??null))==$key?"selected":''}}>{{translator($position)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row g-1">
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="entry-type">{{translator('Execution')}} <span style="color: red;">*</span></label>
            <select name="entry-type" id="" class="form-control">
                @foreach (\App\Models\Trade::ENTRY_TYPE as $key => $entryType)
                    <option value="{{$key}}" {{(old('entry-type')??($lastTrade->entry_type??null))==$key?"selected":''}}>{{translator($entryType)}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="open-price">{{translator('Open Price')}} <span style="color: red;">*</span></label>
            <input type="text"  pattern="[0-9]*[.]?[0-9]*" name="open-price" id="" value="{{old("open-price")??($lastTrade->open_price??null)}}" class="form-control number-only" placeholder="{{translator('0')}}" required>
        </div>
        <div class="col-6 col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="open-date">{{translator('Open Date')}} <span style="color: red;">*</span></label>
            <input type="date" name="open-date" id="" value="{{old("open-date")??convertTimeToUser(getCurrentDatetime(),'Y-m-d')}}" class="form-control" required>
        </div>
    </div>
    <div class="row g-1">
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <h4 class="header-label">{{translator('Closing & Profit')}}</h4>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="row g-1">
                        <div class="col-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="close-position">{{translator('Closing Type')}}</label>
                            <select name="close-position" id="" class="form-control" placeholder="{{translator('Close Position Type')}}">
                                <option value="" {{old("close-position")==""?"selected":""}}>{{translator('None')}}</option>
                                @foreach (\App\Models\Trade::CLOSE_POSITION as $key => $closeProfit)
                                    <option value="{{$key}}" {{old('close-position')==$key?"selected":''}}>{{translator($closeProfit)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="close-price">{{translator('Close Price')}}</label>
                            <input type="text"  pattern="[0-9]*[.]?[0-9]*" name="close-price" id="" value="{{old("close-price")}}" class="form-control number-only" placeholder="{{translator('0')}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="row g-1">
                        <div class="col-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="profit-status">{{translator('PNL Status')}}</label>
                            <select name="profit-status" id="" class="form-control" placeholder="{{translator('PNL Status')}}">
                                @foreach (\App\Models\Trade::PROFIT_STATUS as $key => $profitStatus)
                                    <option value="{{$key}}" {{old('profit-status')==$key?"selected":''}}>{{translator($profitStatus)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label for="profit-amount">{{translator('PNL Amount')}}</label>
                            <input type="text"  pattern="[0-9]*[.]?[0-9]*" value="{{old("profit-amount")}}" name="profit-amount" id="" class="form-control number-only" placeholder="0">
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
            <h4 class="header-label">{{translator('Fee')}}</h4>
            <div class="row g-1">
                <div class="col-6">
                    <label for="fee">{{translator('Swap+Commission Fee')}}</label>
            <input type="text"  pattern="[0-9]*[.]?[0-9]*" value="{{old("fee-amount")}}" name="fee-amount" id="" class="form-control number-only" placeholder="0">
                </div>
            </div>
        </div>
    </div>
    
    <h4 class="header-label">{{translator('More Detail')}}</h4>
    <div class="row g-1">
        <div class="col-6 col-lg-2 col-md-3 col-sm-3 col-xs-6">
            <label for="duration">{{translator('Duration')}}</label>
            <input type="text"  pattern="[0-9]*[.]?[0-9]*" value="{{old("duration")}}" name="duration" id="" class="form-control number-only" placeholder="{{translator('0')}}">
        </div>
        <div class="col-6 col-lg-2 col-md-3 col-sm-3 col-xs-6">
            <label for="duration-type">{{translator('Duration Type')}}</label>
            <select name="duration-type" id="" class="form-control">
                <option value="Minute" {{old("duration-type")=="Minute"?"selected":""}}>Minute</option>
                <option value="Hour" {{old("duration-type")=="Hour"?"selected":""}}>Hour</option>
                <option value="Day" {{old("duration-type")=="Day"?"selected":""}}>Day</option>
                <option value="Week" {{old("duration-type")=="Week"?"selected":""}}>Week</option>
                <option value="Month" {{old("duration-type")=="Month"?"selected":""}}>Month</option>
            </select>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <label for="trading-session">{{translator('Trading Session')}}</label>
            <input type="text" name="trading-session" id="" value="{{old("trading-session")}}" class="form-control" placeholder="{{translator('Trading Session')}}">
        </div>
        <div class="col">
            <label for="remark">{{translator('Remark')}}</label>
            <textarea type="text" class="form-control" value="" name="remark" rows="4" placeholder="{{translator('Remark')}}">{{old("remark")}}</textarea>
        </div>
    </div>
    <br>
    
    <div class="floating-container">
        <div class="floating-button">
            <div class="row g-1">
                <div class="col">
                    <button type="button" class="btn btn-danger" id="btnClear">{{translator('Clear')}}</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">{{translator('Save')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>