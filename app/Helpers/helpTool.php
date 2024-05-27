<?php
use Carbon\Carbon;

function translator($key = ''){
    $currentLocale = getCurrentLocale();
    $separator = explode(":_",$key);
    if(!empty($separator) && count($separator)>1){
        $newKey = $separator[0].'.'.$separator[1];
        return str_replace($separator[0].".","",trans($newKey,[],strtolower($currentLocale)));
    }
    return str_replace("general.","",trans("general.".$key,[],strtolower($currentLocale)));
    // dd(trans('login.'.$key,[],strtolower($currentLocale)));
}

function getCurrentLocale(){
    $fromReq = request()->get('lang');
    $currentLocale = $fromReq??'en';
    return $currentLocale;
}
function getLocales(){
    return [
        'en',
        'kh'
    ];
}

function traderNothere(){
    if(!auth()->user() && request()->getPathInfo()!='/login'){
        return true;
    }elseif($user = auth()->user()){
        $traderRoleId = (new \App\Http\Controllers\AuthController())->getRoleId('trader');
        if($user->role_id!=$traderRoleId){
            return true;
        }
    }
    return false;
}

function throwErrorMsg($msg, $key = 'error'){
    $error = \Illuminate\Validation\ValidationException::withMessages([
        $key => $msg,
     ]);
    throw $error;
}

function getCurrentDatetime(){
    $currentTime = Carbon::now();
    return $currentTime->toDateTimeString();
}

function correctUserTime($date){
    $user = auth()->user();
    $userTimeZone = str_replace("UTC","",$user->time_zone);
    if(strpos("+",$userTimeZone)!==false){
        $date = $date->addHours(str_replace("+","",$userTimeZone));
    }elseif(strpos($userTimeZone,"-")!==false){
        $date = $date->subHours(str_replace("-","",$userTimeZone));
    }
    return $date;
}
function reverseUserTimeToLocal($date){
    $user = auth()->user();
    $userTimeZone = str_replace("UTC","",$user->time_zone);
    if(strpos($userTimeZone,"+")!==false){
        $date = $date->subHours(str_replace("+","",$userTimeZone));
    }elseif(strpos($userTimeZone,"-")!==false){
        $date = $date->addHours(str_replace("-","",$userTimeZone));
    }
    return $date;
}
/**
 * Sameple format Y-M-d H:i:s = 2023-10-31 21:38:07 || h:i A
 */
function convertTimeToUser($utcTime,$format = ""){
    $time = Carbon::parse($utcTime);
    $time = correctUserTime($time);
    if(empty($format)){
        return Carbon::parse($time)->diffForHumans();
    }
    return $time->format($format);
}
function convertLocalToTime($time,$format = "h:i A"){
    $time = Carbon::parse($time);
    $time = reverseUserTimeToLocal($time);
    return $time->format($format);
}

function userAvatar($user,$isSmall = false){
    return view('layout.avatar',compact('user','isSmall'));
}

function globalCcySymbol($getCode = false){
    if($getCode) return "USD";
    return "$";
}

function contactEmail(){
    return "support@mtj.com";
}

function getDefDesc(){
    return 'MTJ - Your Ultimate Trading Companion for Consistent Profitability. Keep track of your trades, stay motivated, learn strategies and engage with a community of traders.';
}
function getDefDescOnWelcome(){
    return 'Your Ultimate Trading Companion for Consistent Profitability.<br> Keep track of your trades, stay motivated, learn strategies and engage with a community of traders.';
}