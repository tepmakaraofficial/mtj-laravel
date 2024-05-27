<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class Trade extends Model
{
    use HasFactory;
    protected $table = 'trades';
    // public $trading_type;
    // public $fk_user;
    // public $platform;
    // public $fk_account;
    // public $pair;
    // public $size;
    // public $strategy;
    // public $entry_type;
    // public $profit_status;
    // public $emotion_status;
    // public $profit_type;
    // public $profit_amount;
    // public $session;
    // public $close_position;
    // public $open_price;
    // public $close_price;
    // public $duration_min;
    // public $remark;
    // public $created_at;
    // public $updated_at;

    const PROFIT_STATUS = [
        0=>"Pending",
        1=>"Win",
        2=>"Loss"
    ];
    const PROFIT_TYPE = [
        1=>"Amount",
        2=>"Percentage (%)"
    ];
    const DURATION_TYPE = [
        "Minute"=>"Minute",
        "Hour"=>"Hour",
        "Day"=>"Day",
        "Week"=>"Week",
        "Month"=>"Month"
    ];
    const ENTRY_TYPE = [
        "Market"=>"Market",
        "Limit"=>"Limit",
        "Stop Market"=>"Stop Market"
    ];
    const CLOSE_POSITION = [
        "Manually"=>"Manually",
        "TP"=>"TP",
        "SL"=>"SL",
        "Breakeven"=>"Breakeven"
    ];
    const POSITIONS = [
        "Buy"=>"Buy",
        "Sell"=>"Sell"
    ];

    public function validate(){
        $this->size = str_replace(",",".",$this->size);
        $pendingStatus = $this->profit_status!=1&&$this->profit_status!=2;
        if((!empty($this->profit_amount)) && $pendingStatus){
            throwErrorMsg(translator("Please update profit status to Win or Loss first."));
        }
        if((empty($this->size)) || !is_numeric($this->size)){
            throwErrorMsg(translator("Invalid margin size."));
        }
        if((empty($this->open_price)) || !is_numeric($this->open_price)){
            throwErrorMsg(translator("Invalid open price."));
        }
        if((!empty($this->duration_min)) && !is_numeric($this->duration_min)){
            throwErrorMsg(translator("Invalid duration."));
        }
        if((!empty($this->profit_amount)) && empty($this->close_price)){
            throwErrorMsg(translator("You must have profit amount and closing price."));
        }
        if(!empty($this->profit_amount) && ($this->profit_amount<0 || !is_numeric($this->profit_amount)) ){
            throwErrorMsg(translator("Invalid profit amount"));
        }
        if((!empty($this->close_price)) && !isset($this::CLOSE_POSITION[$this->close_position])){
            throwErrorMsg(translator("You have enter close price so please choose close position type also."));
        }
        if(!empty($this->close_price) && ($this->close_price<0 || !is_numeric($this->close_price)) ){
            throwErrorMsg(translator("Invalid close price"));
        }
        if((!empty($this->close_position) && empty($this->close_price))){
            throwErrorMsg(translator("Position type must have close price"));
        }
        if(empty($this->fk_account)){
            throwErrorMsg(translator("You must select an account first. Please go to setting page to manage your accounts."));
        }
        // if(!isset(self::getAllEmotions()[$this->emotion_status])){
        //     throwErrorMsg(translator("Invalid emotion status please try again."));
        // }
        if(!isset($this::getTradingType()[$this->trading_type])){
            throwErrorMsg(translator("Invalid trading type please try again."));
        }
        if(!isset($this::ENTRY_TYPE[$this->entry_type])){
            throwErrorMsg(translator("Invalid entry type please try again."));
        }
        if(!isset($this::POSITIONS[$this->position])){
            throwErrorMsg(translator("Invalid position please try again."));
        }
        if(!empty($this->profit_type)&&!isset($this::PROFIT_TYPE[$this->profit_type])){
            throwErrorMsg(translator("Invalid profit type please try again."));
        }
        if(!empty($this->profit_status)&&!isset($this::PROFIT_STATUS[$this->profit_status])){
            throwErrorMsg(translator("Invalid profit status please try again."));
        }
    }

    public static function getAllEmotions():array {
        return [
            '1'=>translator("Normal (Follow Strategy)"),
            '2'=>translator("Fear of missing out(FOMO)"),
            '3'=>translator("Anger"),
            '4'=>translator("Revenge"),
        ];
    }

    public static function getTradingType():array{
        $def = [
            "Crypto"=>"Crypto",
            "Forex"=>"Forex",
            "Stock"=>"Stock"
        ];
        $fromSetting = setting('site.trading_pair');
        $tradingType = $def;
        if(!empty($fromSetting)){
            $fromSetting = json_decode($fromSetting,true);
            $tradingType = [];
            foreach ($fromSetting as $key => $value) {
                $tradingType[$value]=$value;
            }
        }
        return $tradingType;
    }

    public function getAllVars(){
        return [
        'trading_type'=>$this->trading_type,
        'fk_user'=>$this->fk_user
        ,'platform'=>$this->platform
        ,'fk_account'=>$this->fk_account
        ,'pair'=>$this->pair
        ,'size'=>$this->size
        ,'strategy'=>$this->strategy
        ,'entry_type'=>$this->entry_type
        ,'profit_status'=>$this->profit_status
        ,'emotion_status'=>$this->emotion_status
        ,'profit_type'=>$this->profit_type
        ,'profit_amount'=>$this->profit_amount
        ,'session'=>$this->session
        ,'close_position'=>$this->close_position
        ,'open_price'=>$this->open_price
        ,'close_price'=>$this->close_price
        ,'duration_min'=>$this->duration_min
        ,'remark'=>$this->remark
        ,'created_at'=>$this->created_at
        ,'updated_at'=>$this->updated_at
        ,'position'=>$this->position
        ,'fee_amount'=>$this->fee_amount
        ];
    }

    public function account(){
        return $this->belongsTo(Account::class,'fk_account');
    }
    public function displaySizeByType($size,$type){
        switch ($type) {
            case 'Crypto':
                $size = $size.' usdt';
                break;
            case 'Forex':
                $size = $size.' lot';
                break;
            case 'Stock':
                $size = $size.' share';
                break;
        }
        return $size;
    }

    public static function getPNL($trades){
        $win = 0;
        $loss = 0;
        $fee = 0;
        foreach ($trades as $trade) {
            $fee += ($trade->fee_amount??0);
            //Win
            if($trade->profit_status==1){
                $win += ($trade->profit_amount??0);
            }
            //Loss
            elseif($trade->profit_status==2){
                $loss += ($trade->profit_amount??0);
            }
        }
        $loss = $loss+$fee;
        return [
            'win'=>$win,
            'loss'=>$loss
        ];
    }

}
