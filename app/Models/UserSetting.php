<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;
    protected $table = "user_settings";
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = -1;
    const ALL_KEYS = [
        "PLATFORM",
        "STRATEGY",
        "PAIR",
        "TRADING_TYPE",
        "PAIR_Forex",
        "PAIR_Crypto",
        "PAIR_Stock"
    ];
    const ALL_PAIR_TYPES = [
        "PAIR_Forex",
        "PAIR_Crypto",
        "PAIR_Stock",
        "PAIR"
    ];

    public static function validate($key, $value){
        if(!isset(array_flip(self::ALL_KEYS)[$key])){
            throwErrorMsg("Invalid key setting!");
        }
    }
    
    public static function getPlatform($dataList){
        return $dataList->where('key','PLATFORM');
    }
    public static function getStrategy($dataList){
        return $dataList->where('key','STRATEGY');
    }
    public static function getPair($dataList){
        return $dataList->whereIn('key',self::ALL_PAIR_TYPES);
    }
    public static function getTradingType($dataList=null){
        if(empty($dataList)){
            $user = auth()->user();
            return self::where('key','TRADING_TYPE')->where('fk_user',$user->id)->get();
        }
        return $dataList->where('key','TRADING_TYPE');
    }
    
}
