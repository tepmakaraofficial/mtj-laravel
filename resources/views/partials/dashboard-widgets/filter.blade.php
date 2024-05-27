<style>
.filterContainer{
    padding: 5%;
}
</style>
<div class="card filterContainer">
    <form action="/" method="get">
        <div class="row align-items-center">
            <div class="col-8">
                <label>{{translator("Selected Month")}}</label>
                <select name="current_month" id="" class="form-control mb-2">
                    @php
                        $dateTime = new DateTime();
                    @endphp
                    @for ($i = 0; $i < 12; $i++)
                        <option value="{{$dateTime->format('m-Y')}}">{{$i==0?$dateTime->format('F-Y').'(This Month)':$dateTime->format('F-Y')}}</option>
                        @php
                            $dateTime->modify('-1 month')
                        @endphp
                    @endfor
                </select>
                @php
                    $getMyTradingType = \App\Models\UserSetting::getTradingType($getUserSetting)->pluck('value')->toArray();
                @endphp
                <label>{{translator("Trading Type")}}</label>
                <select name="trading_type" id="" class="form-control mb-2">
                    @foreach ($getMyTradingType as $item)
                        <option value="{{$item}}" {{request()->get('trading_type')==$item?'selected':''}}>{{$item}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <a href="/"><button type="button" class="btn mb-2" style="background-color: #717571;color:rgb(227, 238, 248);">Reset</button></a>
                <button type="submit" class="btn" style="background-color: #198754;color:aliceblue;">Search</button>
            </div>
        </div>
    </form>
</div>