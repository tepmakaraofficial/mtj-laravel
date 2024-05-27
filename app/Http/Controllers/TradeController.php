<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trade;
use App\Models\Account;

use Illuminate\View\View;
use App\Models\UserSetting;
use App\Models\MistakeNotes;
use Illuminate\Http\Request;
use function Termwind\render;

class TradeController extends Controller
{
    public function create(Request $request){
        // throwErrorMsg(translator("What the fuck?"));
        // return redirect()->back()->with('message', 'Added successfully');
        // dd($request);
        $user = auth()->user();
        $model = new Trade();
        $model->fk_user = $user->id;
        $model->platform = $request->get("platform");
        $model->fk_account = $request->get("account");
        $model->strategy = $request->get("strategy");
        $model->size = $request->get("size");
        $model->pair = $request->get("pair");
        $model->position = $request->get("position");
        $model->entry_type = $request->get("entry-type");
        $model->session = $request->get("trading-session");
        $model->open_price = $request->get("open-price");
        $model->close_price = $request->get("close-price");
        $model->close_position = $request->get("close-position");
        $model->profit_status = $request->get("profit-status");
        $model->profit_type = 1;//is must use default amount to avoid complicate
        $model->profit_amount = $request->get("profit-amount");
        $model->emotion_status = $request->get("emotion-status");
        $model->remark = $request->get("remark");
        $model->created_at = getCurrentDatetime();
        $model->updated_at = getCurrentDatetime();
        $model->trading_type = $request->get("trading-type");
        $model->fee_amount = $request->get("fee-amount")??0;
        if(!empty($request->get("open-date"))){
            $model->created_at = $request->get("open-date")." ".\Carbon\Carbon::now()->format('H:i:s');
        }

        $duration = $request->get("duration");
        $durationType = Trade::DURATION_TYPE[$request->get("duration-type")]??'';
        if(!empty($duration) && !empty($durationType)){
            switch ($durationType) {
                case "Hour":
                    $duration = $duration*60;
                    break;
                case "Day":
                    $duration = ($duration*60)*24;
                    break;
                case "Week":
                    $duration = (($duration*60)*24)*7;
                    break;
                case "Month":
                    $duration = ((($duration*60)*24)*7)*30;
                    break;
                
            }
            $model->duration_min = $duration;
        }
        $model->validate();
        $model->insert($model->getAllVars());
        return redirect()->to('/trade/list')->with('message', 'Added successfully.');
    }

    function delete($id){
        $user = auth()->user();
        Trade::where('fk_user',$user->id)
            ->where('id',$id)->delete();
        return redirect()->to('/trade/list')->with('message', 'You just delete an order successfully.');
    }

    function createForm() : View {
        $user = auth()->user();
        $getUserSetting = UserSetting::where('fk_user',$user->id)
                    ->where("status",UserSetting::STATUS_SUCCESS)
                    ->orderBy('position')->get();
        $getAccounts = Account::where('fk_user',$user->id)
                    ->get();
        $lastTrade = Trade::with('account')->where('fk_user',$user->id)->orderBy('id',"DESC")->first();
        return view('home',compact('getUserSetting','getAccounts','lastTrade'));
    }
    function editForm(Request $request, $id) : View {
        $user = auth()->user();
        $getUserSetting = UserSetting::where('fk_user',$user->id)
                    ->where("status",UserSetting::STATUS_SUCCESS)
                    ->orderBy('position')->get();
        $getAccounts = Account::where('fk_user',$user->id)
                    ->get();
        $trade = Trade::with('account')
                    ->where('fk_user',$user->id)
                    ->where('id',$id)->first();
        return view('home',compact('getUserSetting','getAccounts','trade'));
    }
    
    function list(Request $request) : View {
        
        $allMoreSearch = [
            "strategy"=>"Strategy",
            "pair"=>"Pair",
            "entry_type"=>"Entry Type",
            "size"=>"Size",
            "platform"=>"Platform",
            "trading_type"=>"Trading Type",
            "position"=>"Position",
            "profit_status"=>"Profit Status",
            "remark"=>"Remark",
        ];
        $user = auth()->user();
        $getAccounts = Account::where('fk_user',$user->id)
                    ->get();
        $tradesSql = Trade::with('account')->where('fk_user',$user->id);
        if(!empty($request->get('account')) && $request->get('account')!='all'){
            $tradesSql->where('fk_account',$request->get('account'));
        }
        if(!empty($request->get('search')) && isset($allMoreSearch[$request->get('key_search')])){
            $tradesSql->where($request->get('key_search'),$request->get('search'));
        }
        if(!empty($request->get('fromdate')) && !empty($request->get('todate'))){
            $userTimeZone = str_replace("UTC","",$user->time_zone);
            $fromDate = Carbon::createFromFormat('Y-m-d', $request->get('fromdate'));
            $toDate = Carbon::createFromFormat('Y-m-d', $request->get('todate'));
            if(strpos($userTimeZone,"+")!==false){
                $fromDate = $fromDate->subHours(str_replace("+","",$userTimeZone));
                $toDate = $toDate->addHours(str_replace("+","",$userTimeZone));
            }elseif(strpos($userTimeZone,"-")!==false){
                $fromDate = $fromDate->addHours(str_replace("-","",$userTimeZone));
                $toDate = $toDate->subHours(str_replace("-","",$userTimeZone));
            }

            $fromDate = $fromDate->format('Y-m-d')." 00:00:00";
            $toDate = $toDate->format('Y-m-d')." 23:59:59";
            $tradesSql->where('created_at','>=',$fromDate)->where('created_at','<=',$toDate);
        }
        $trades = $tradesSql->orderBy('id','desc')->paginate(10);
        return view('home',compact('trades','getAccounts','allMoreSearch'));
    }
    
    function setting() : View {
        $user = auth()->user();
        $getUserSetting = UserSetting::where('fk_user',$user->id)
                        ->where("status",UserSetting::STATUS_SUCCESS)
                        ->orderBy('position')->get();
        $getAccounts = Account::where('fk_user',$user->id)
                        ->get();
        return view('home',compact('user','getUserSetting','getAccounts'));
    }

    public function detail($id) {
        $user = auth()->user();
        $isModal = request()->get('is_modal')==="true";
        $trade = Trade::with('account')
                ->where('fk_user',$user->id)
                ->where('id',$id)->first();
        return view('home',compact('trade','isModal'));
    }
    // public function edit($id) {
    //     $user = auth()->user();
    //     $isModal = request()->get('is_modal')==="true";
    //     $trade = Trade::with('account')
    //             ->where('fk_user',$user->id)
    //             ->where('id',$id)->first();
    //     if(!$trade)throwErrorMsg(translator("Invalid trade id"));
        
    //     $detailView = view('trade-edit',compact('trade','isModal'))->render();
    //     return response($detailView);
    // }
    public function save(Request $request, $id) {
        $user = auth()->user();
        $trade = Trade::with('account')
                ->where('fk_user',$user->id)
                ->where('id',$id)->first();
        if(!$trade)throwErrorMsg(translator("Invalid trade id"));
        $trade->platform = $request->get("platform");
        $trade->fk_account = $request->get("account");
        $trade->strategy = $request->get("strategy");
        $trade->size = $request->get("size");
        $trade->pair = $request->get("pair");
        $trade->position = $request->get("position");
        $trade->entry_type = $request->get("entry-type");
        $trade->session = $request->get("trading-session");
        $trade->open_price = $request->get("open-price");
        $trade->close_price = $request->get("close-price");
        $trade->close_position = $request->get("close-position");
        $trade->profit_status = $request->get("profit-status");
        $trade->profit_type = 1;//is must use default amount to avoid complicate
        $trade->profit_amount = $request->get("profit-amount");
        $trade->emotion_status = $request->get("emotion-status");
        $trade->remark = $request->get("remark");
        $trade->created_at = getCurrentDatetime();
        $trade->updated_at = getCurrentDatetime();
        $trade->trading_type = $request->get("trading-type");
        $trade->fee_amount = $request->get("fee-amount")??0;
        
        $duration = $request->get("duration");
        $durationType = Trade::DURATION_TYPE[$request->get("duration-type")]??'';
        if(!empty($duration) && !empty($durationType)){
            switch ($durationType) {
                case "Hour":
                    $duration = $duration*60;
                    break;
                case "Day":
                    $duration = ($duration*60)*24;
                    break;
                case "Week":
                    $duration = (($duration*60)*24)*7;
                    break;
                case "Month":
                    $duration = ((($duration*60)*24)*7)*30;
                    break;
                
            }
            $trade->duration_min = $duration;
        }
        if(!empty($request->get('open-date'))){
            $trade->created_at = convertLocalToTime($request->get('open-date'),'Y-m-d H:i:s');
        
        }
        
        $trade->validate();
        $trade->save();
        return redirect()->to('/trade/detail/'.$trade->id)->with('message', 'Update successfully.');
    }
}
