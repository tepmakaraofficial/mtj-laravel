<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Trade;
use App\Models\Account;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use stdClass;

class DashboardController extends Controller
{
    public function pnl(Request $request){
        Log::debug("kk");
        $user = auth()->user();
        $data = [
            'YESTERDAY'=>'0',
            'TODAY'=>'0',
            'MONTH'=>'0',
            'WEEK'=>'0',
            'LAST_WEEK'=>'0',
            'LAST_MONTH'=>'0',
            'LAST_6_MONTH'=>'0',
            'LAST_YEAR'=>'0',
        ];
        $yesterDayTrade = $this->tradeQuery()->whereDate('created_at', Carbon::now()->subDays(1))->get();
        $todayTrade = $this->tradeQuery()->whereDate('created_at', date('Y-m-d'))->get();
        $weekTrade = $this->tradeQuery()->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $monthTrade = $this->tradeQuery()->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
        $lastWeekTrade = $this->tradeQuery()->whereBetween('created_at', [Carbon::now()->subWeek(1)->startOfWeek(), Carbon::now()->subWeek(1)->endOfWeek()])->get();
        $lastMonthTrade = $this->tradeQuery()->whereYear('created_at', Carbon::now()->subMonth(1)->format("Y"))->whereMonth('created_at', Carbon::now()->subMonth(1)->format("m"))->get();
        $last6MonthTrade = $this->tradeQuery()->whereBetween('created_at', [Carbon::now()->subMonth(6)->startOfMonth(), Carbon::now()->subMonth(1)->endOfMonth()])->get();
        $lastYearTrade = $this->tradeQuery()->whereYear('created_at', Carbon::now()->subYear(1)->format("Y"))->get();
        $data['yesterday_count'] = count($yesterDayTrade);
        $data['today_count'] = count($todayTrade);
        $data['week_count'] = count($weekTrade);
        $data['month_count'] = count($monthTrade);
        $data['last_week_count'] = count($lastWeekTrade);
        $data['last_month_count'] = count($lastMonthTrade);
        $data['last_6_month_count'] = count($last6MonthTrade);
        $data['last_year_count'] = count($lastYearTrade);
        $yesterday = Trade::getPNL($yesterDayTrade);
        $today = Trade::getPNL($todayTrade);
        $week = Trade::getPNL($weekTrade );
        $month = Trade::getPNL($monthTrade);
        $lastWeek = Trade::getPNL($lastWeekTrade);
        $lastMonth = Trade::getPNL($lastMonthTrade);
        $last6Month = Trade::getPNL($last6MonthTrade);
        $lastYear = Trade::getPNL($lastYearTrade);
        $data['YESTERDAY']=$yesterday['win']-$yesterday['loss'];
        $data['TODAY']=$today['win']-$today['loss'];
        $data['WEEK']=$week['win']-$week['loss'];
        $data['MONTH']=$month['win']-$month['loss'];
        $data['LAST_WEEK']=$lastWeek['win']-$lastWeek['loss'];
        $data['LAST_MONTH']=$lastMonth['win']-$lastMonth['loss'];
        $data['LAST_6_MONTH']=$last6Month['win']-$last6Month['loss'];
        $data['LAST_YEAR']=$lastYear['win']-$lastYear['loss'];
        $view = view('partials.dashboard-widgets.pnl',compact('data'))->render();
        return response($view);
    }

    public function activeAccount(Request $request){
        $user = auth()->user();
        // $trading_type = "Forex";
        
        $getAccounts = Account::where('fk_user',$user->id)
                        // ->where('trading_type',$trading_type)
                        ->whereRaw('(SELECT tr.id FROM trades AS tr WHERE tr.fk_account=accounts.id LIMIT 1) IS NOT NULL')
                        ->orderBy('id',"DESC")
                        ->where('status',Account::STATUS_ACTIVE)->get();
        
        $accountId = $request->get('account');
        if(empty($accountId)){
            $accountId = $getAccounts[0]->id??-1;
        }
        $account = Account::where('fk_user',$user->id)
                        // ->where('trading_type',$trading_type)
                        ->whereRaw('(SELECT tr.id FROM trades AS tr WHERE tr.fk_account=accounts.id LIMIT 1) IS NOT NULL')
                        ->where('status',Account::STATUS_ACTIVE)
                        ->where('id',$accountId)
                        ->first();
        if($account){
            $getAllOrders = Trade::where('fk_user',$user->id)
                ->where('fk_account',$account->id)
                ->select('fee_amount','profit_amount','profit_status')
                ->get();
            $account->count_order = count($getAllOrders);
            $getPnl = Trade::getPNL($getAllOrders);
            $account->pnl = $getPnl['win']-$getPnl['loss'];
            
        }
        
        $view = view('partials.dashboard-widgets.accounts',compact('getAccounts','account'))->render();
        return response($view);
    }

    public function weeklyPnl(){
        // Get the start and end of the week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();//Carbon::now();
        // Create an array to hold the days of the week
        $days = [];
        $pnlByDays = [];
        // Loop through each day of the week
        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $days[] = $date->format('D');
            $getTrade = $this->tradeQuery()->whereDate('created_at', $date->format('Y-m-d'))->get();
            
            if($getTrade->isNotEmpty()){
                $winOrLoss = Trade::getPNL($getTrade);
                $pnlByDays[] = $winOrLoss['win']-$winOrLoss['loss'];
            }else{
                $pnlByDays[] = 0;
            }
        }
        $data = [
            'label'=>$days,
            'data_set'=>$pnlByDays
        ];
        $view = view('partials.dashboard-widgets.weekly-pnl',compact('data'))->render();
        return response($view);
    }

    public function monthlyPnl(){
        // Get the start and end of the week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now();//->endOfWeek();
        // Create an array to hold the days of the week
        $months = [];
        $pnlByMonths = [];

        $dateTime = new \DateTime();
        for ($i = 0; $i < 12; $i++){
            $months[]=$dateTime->format('M-y');
            $getTrade = $this->tradeQuery()->whereMonth('created_at', $dateTime->format('m'))->get();
            
            if($getTrade->isNotEmpty()){
                $winOrLoss = Trade::getPNL($getTrade);
                $pnlByMonths[] = $winOrLoss['win']-$winOrLoss['loss'];
            }else{
                $pnlByMonths[] = 0;
            }
            $dateTime->modify('-1 month');
        }
          
        $data = [
            'label'=>array_reverse($months),
            'data_set'=>array_reverse($pnlByMonths)
        ];
        $view = view('partials.dashboard-widgets.monthly-pnl',compact('data'))->render();
        return response($view);
    }

    public function execution(){
        $label = [
            "Market",
            "Limit",
            "Stop Market",
        ];
     
        $color=[
            "#cc6729",
            "#4f8546",
            "#3d59d4",
        ];
        $data = $this->tradeQuery()->get();
        $dataSet=[];
        foreach ($label as $key => $value) {
            $dataSet[]=$data->where('entry_type',$value)->count();
        }
        $data = [
            'label'=>$label,
            'data_set'=>$dataSet,
            'color'=>$color
        ];
        // dd($data);
        $view = view('partials.dashboard-widgets.execution',compact('data'))->render();
        return response($view);
    }
    public function montlyWinLoss(){
        // Get the start and end of the week
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now();//->endOfWeek();
        // Create an array to hold the days of the week
        $months = [];
        $winDataSet = [];
        $lossDataSet = [];

        $dateTime = new \DateTime();
        for ($i = 0; $i < 12; $i++){
            $months[]=$dateTime->format('M-y');
            $getTrade = $this->tradeQuery()->whereMonth('created_at', $dateTime->format('m'))->get();
            if($getTrade->isNotEmpty()){
                $winOrLoss = Trade::getPNL($getTrade);
                $winDataSet[] = $winOrLoss['win'];
                $lossDataSet[] = -$winOrLoss['loss'];
            }else{
                $winDataSet[] = 0;
                $lossDataSet[] = 0;
            }
            $dateTime->modify('-1 month');
        }
          
        $data = [
            'label'=>array_reverse($months),
            'win_data_set'=>array_reverse($winDataSet),
            'loss_data_set'=>array_reverse($lossDataSet),
        ];
        $view = view('partials.dashboard-widgets.monthly-win-loss',compact('data'))->render();
        return $view;
    }
    public function topOrders(){
        $user = auth()->user();
        $pending = $this->tradeQuery()->where('profit_status',0)->limit(3)->get();
        
        // $pairs = UserSetting::where('fk_user',$user->id)->where('key','PAIR_Forex')
        //             ->select("*")
        //             ->addSelect(\DB::raw('(SELECT COUNT(tr.id) FROM trades AS tr WHERE tr.pair=user_settings.value) AS count_order'))
        //             ->orderBy('position')->limit(7)->get();
        $win = $this->tradeQuery()->where('profit_status',1)->orderBy('profit_amount','DESC')->limit(6)->get();
        $loss = $this->tradeQuery()->where('profit_status',2)->orderBy('profit_amount','DESC')->limit(6)->get();
        $view = view('partials.dashboard-widgets.top-orders',compact('pending','win','loss'))->render();
        return response($view);
    }
    public function openClose(){
        
        $trades = $this->tradeQuery()->get();
        $manuallyCount = $trades->where('close_position','Manually')->count();
        $tpCount = $trades->where('close_position','TP')->count();
        $slCount = $trades->where('close_position','SL')->count();
        $breakevenCount = $trades->where('close_position','Breakeven')->count();
        $total = $manuallyCount+$tpCount+$slCount+$breakevenCount;
        $data = [
            'Manually_count'=>"$manuallyCount",
            'TP_count'=>"$tpCount",
            'SL_count'=>"$slCount",
            'Breakeven_count'=>"$breakevenCount",
            'Manually_percent'=>$total>0?round(($manuallyCount*100)/$total,2):0,
            'TP_percent'=>$total>0?round(($tpCount*100)/$total,2):0,
            'SL_percent'=>$total>0?round(($slCount*100)/$total,2):0,
            'Breakeven_percent'=>$total>0?round(($breakevenCount*100)/$total,2):0,
        ];
        
        $view = view('partials.dashboard-widgets.open-close',compact('data'))->render();
        return response($view);
    }

    
    public function tradeQuery(){
        $user = auth()->user();
        $accountId = request()->get('account');
        if(empty($accountId)){
            $getAccount = \App\Models\Account::where('fk_user',$user->id)
            ->whereRaw('(SELECT tr.id FROM trades AS tr WHERE tr.fk_account=accounts.id LIMIT 1) IS NOT NULL')
            ->orderBy('id',"DESC")
            ->where('status',Account::STATUS_ACTIVE)
            ->first();
            $getAccount?$accountId=$getAccount->id:'';
        }
        if(empty($accountId)){
            $accountId = -1;
        }
        $tradeQuery = Trade::where('fk_user',$user->id)
                    ->where('fk_account',$accountId)
                    ->select('fee_amount','profit_amount',
                    'profit_status','entry_type','position','pair','size'
                    ,'close_position'
                    )
                    ;
        return $tradeQuery;
    }
}
