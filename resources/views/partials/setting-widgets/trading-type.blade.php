<style>
    .settingTradingTypeChild{
        padding: 2%;
        /* max-width: 50%; */
    }
    /* .settingTradingType{
        background-color: #fcfcfc;
    }
    .dark .settingTradingType{
        background-color: #212529;
    } */
    .allSupport{
        background-color: #e2e2e2;
        border-radius:10px;
        padding:2%;
        margin:0.5%;
        text-align:center;
        cursor:pointer;
    }
    .dark .allSupport{
        background-color: #4e4d4d;
        border-radius:10px;
        padding:2%;
        margin:0.5%;
        text-align:center;
        cursor:pointer;
    }
</style>
<div class="settingTradingType mb-2">
    <div class="settingTradingTypeChild">
        <h5 class="widgetTitle">{{translator("Manage your trading type")}}</h5>
        <h6>Selected : </h6>
        @php
            $getMyTradingType = \App\Models\UserSetting::getTradingType($getUserSetting)->pluck('value')->toArray();
        @endphp
        <p>
            @if (!empty($getMyTradingType))
            @foreach ($getMyTradingType as $item)
                <span style="background-color: #198753;color:white;border-radius:10px;padding:2%;margin:0.5%;text-align:center;cursor:pointer;">{{$item}} <i class="bi bi-dash-circle fs-3" onclick="removeSettingTradingType('{{$item}}')"></i></span>
            @endforeach
            @else
                <p>Not Set <span style="color: red;">*</span></p>
            @endif
        </p>
        
        <h6>All Supported Type :</h6>
        <p>
            @foreach (\App\Models\Trade::getTradingType() as $item)
                <span class="allSupport">{{$item}} @if (!isset(array_flip($getMyTradingType)[$item]))<i class="bi bi-plus-circle fs-3" onclick="addSettingTradingType('{{$item}}')"></i>@else<i class="bi bi-check2-circle fs-3"></i>@endif</span>
               
            @endforeach
        </p>
    </div>
</div>