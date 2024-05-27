@section('style')
<style>
    .tradeList th{
        color: #034303 !important;
    }
    .dark .tradeList th{
        color: #3ca876 !important;
    }
    .dark .tradeList td p{
        color: #b3b5bd;
    }
    .tradeList{
        max-width: 100%;
        overflow: scroll;
        min-height: 720px;
        padding: 1%;
    }
    .date{
        font-size: 60%;
        color:rgb(39, 37, 37);
    }
    .dark .date{
        font-size: 60%;
        color:rgb(185, 184, 184);
    }
    .pending{
        color:#272727;
    }
    .dark .pending{
        color:#c0bbbb;
    }
</style>
@endsection
<div class="tradeList">
    <div class="btn-group dropend">
        <i class="bi bi-funnel-fill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 150%;color:#3ca876;"></i>
        <ul class="dropdown-menu" style="width:350px;">
          <form action="" style="padding:7%;">
            <div class="row g-1">
                <div class="col-6 mb-2">
                    <input type="date" class="form-control" name="fromdate" value="{{request()->get("fromdate")}}">
                </div>
                <div class="col-6">
                    <input type="date" class="form-control" name="todate" value="{{request()->get("todate")}}">
                </div>
            </div>
            <div class="row g-1">
                <div class="col-12 mb-1">
                    <select type="text" name="account" class="form-control" id="">
                        <option value="all">{{translator('All Accounts')}}</option>
                        @foreach ($getAccounts as $key=> $account)
                            <option value="{{$account->id}}" {{$account->id==request()->get("account")?"selected":""}}>{{translator($account->name)}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <div class="row g-1">
                        <div class="col-5">
                            <select type="text" name="key_search" class="form-control" id="">
                                @foreach ($allMoreSearch as $key=> $search)
                                    <option value="{{$key}}" {{$key==request()->get("key_search")?"selected":""}}>{{translator($search)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-7">
                            <input type="text" class="form-control mb-2" placeholder="Search any" value="{{request()->get("search")}}" name="search">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-end" style="margin: 2%;">{{translator('Search')}}</button>
            <a href="/trade/list"><button type="button" class="btn btn-secondary float-end " style="margin: 2%;">{{translator('Reset')}}</button></a>
          </form>
        </ul>
    </div>
    <table class="table table-striped">
        <thead >
            <tr>
              <th scope="col">ID&DATE</th>
              <th scope="col">PNL</th>
              <th scope="col">PAIR</th>
              <th scope="col">ACCOUNT</th>
              <th scope="col">SIZE</th>
              <th scope="col">PLATFORM</th>
              <th scope="col">OPENING</th>
              <th scope="col">CLOSING</th>
              <th scope="col">STRATEGY&EMOTION</th>
              <th scope="col">FEE</th>
              <th scope="col">REMARK</th>
              <th></th>
            </tr>
        </thead>
          <tbody>
            
            @foreach ($trades as $trade)
                <tr style="border-left: 4px solid {{$trade->profit_status==0?'grey':($trade->profit_status==1?'green':'red')}};">
                    <td>
                        <a href="/trade/detail/{{$trade->id}}" style="text-decoration: none;"><p style="color:#1d9cd6;">{{str_pad($trade->id, 7, '0', STR_PAD_LEFT)}}<br><span class="date">{{convertTimeToUser($trade->created_at)}}</span></p></a>
                    </td>
                    <td>
                        @if ($trade->profit_status==0)
                            <span  class="pending">Pending</span>
                        @elseif($trade->profit_status==1)
                            <span style="color:#3ca876;font-weight:bold;font-size: 150%;">+{{$trade->profit_amount}}{{$trade->profit_type==2?"%":globalCcySymbol()}}</span>
                        @else
                            <span style="color:red;font-weight:bold;font-size: 150%;">-{{$trade->profit_amount}}{{$trade->profit_type==2?"%":globalCcySymbol()}}</span>
                        @endif
                    </td>
                    <td>
                        <p style="color:#1d9cd6;">{{$trade->pair}}<br><span style="font-size: 70%;color:{{$trade->position=="Buy"?"#3ca876":"red"}};">{{$trade->position=="Buy"?"Buy":"Sell"}}</span></p>
                    <td title="{{$trade->account->name}}"><p><a href="#" style="text-decoration: none;color:#1d9cd6;">{{$trade->account->name}}<br><span style="font-size: 70%;color:#1d9cd6;">{{$trade->account->balance}}{{globalCcySymbol()}}</span></a></p></td>
                    <td><p>{{$trade->displaySizeByType($trade->size,$trade->trading_type)}}<br><span style="font-size: 70%;color:#1d9cd6;">{{$trade->trading_type}}</span></p></td>
                    <td><p>{{$trade->platform}}</p></td>
                    <td><p>{{$trade->entry_type}}<br><span style="font-size: 70%;">{{$trade->open_price}}</span></p></td>
                    <td><p>{{$trade->close_position}}<br><span style="font-size: 70%;color:#1d9cd6;">{{$trade->close_price}}</span></p></td>
                    <td><p>{{$trade->strategy}}<br><span style="font-size: 70%;">{{$trade::getAllEmotions()[$trade->emotion_status]}}</span></p></td>
                    <td><p>{{$trade->fee_amount??0}}{{globalCcySymbol()}}</p></td>
                    <td><p>{{$trade->remark}}</p></td>
                    <td><a href="/trade/detail/{{$trade->id}}"><i class="fa fa-bars" aria-hidden="true"></i></a></td>
                </tr>
            @endforeach
          </tbody>
    </table>
    @if (count($trades)<1)
        <p style="text-align: center;">{{translator("No order found!")}}</p>
    @endif
    {!! $trades->appends([])->links('pagination::bootstrap-5') !!}
    {{-- {!! $trades->withQueryString()->links('pagination::bootstrap-5') !!} --}}
</div>