<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Trade;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{

    function setting() : View {
        $user = auth()->user();
        $getUserSetting = UserSetting::where('fk_user',$user->id)
                        ->where("status",UserSetting::STATUS_SUCCESS)
                        ->orderBy('position')->get();
        $getAccounts = Account::where('fk_user',$user->id)
                        ->orderBy('id',"DESC")
                        ->get();
        return view('setting',compact('user','getUserSetting','getAccounts'));
    }
    function getPairsByKey($hasKey){
        $user = auth()->user();
        $pairs = UserSetting::where('fk_user',$user->id)
        ->where('key',$hasKey)
        ->get();
        $dataArr = [];
        foreach ($pairs as $key => $pair) {
            $dataArr[]=[
                'id'=>$pair->value,
                'text'=>$pair->value,
            ];
        }
        return response(json_encode($dataArr));
    }
    public function addSetting(Request $request){
        $request->validate([
            'key'=>"required",
            'value'=>"required",
        ]);
        $key = $request->get('key');
        $value = $request->get('value');
        $user = auth()->user();
        UserSetting::validate($key,$value);
        UserSetting::insert([
            'fk_user'=>$user->id,
            'key'=>$key,
            'value'=>$value,
            'status'=>UserSetting::STATUS_SUCCESS,
            'created_at'=>getCurrentDatetime(),
            'updated_at'=>getCurrentDatetime(),
        ]);
        return response(["success"=>true]);
    }
    public function addSettingReturnView(Request $request){
        $request->validate([
            'key'=>"required",
            'value'=>"required",
        ]);
        $key = $request->get('key');
        $value = $request->get('value');
        UserSetting::validate($key,$value);
        $user = auth()->user();
        UserSetting::insert([
            'fk_user'=>$user->id,
            'key'=>$key,
            'value'=>$value,
            'status'=>UserSetting::STATUS_SUCCESS,
            'created_at'=>getCurrentDatetime(),
            'updated_at'=>getCurrentDatetime(),
        ]);
        $getUserSetting = UserSetting::where('fk_user',$user->id)
                        ->where("status",UserSetting::STATUS_SUCCESS)
                        ->where('key',$key)
                        ->orderBy('position')->get();
        $view = view('partials.setting-widgets.trading-type',compact('getUserSetting'))->render();
        return response($view);
    }
    public function removeSettingReturnView(Request $request){
        $request->validate([
            'key'=>"required",
            'value'=>"required",
        ]);
        $key = $request->get('key');
        $value = $request->get('value');
        UserSetting::validate($key,$value);
        $user = auth()->user();
        UserSetting::where('fk_user',$user->id)
                        ->where("status",UserSetting::STATUS_SUCCESS)
                        ->where('key',$key)
                        ->where('value',$value)
                        ->delete();
        $getUserSetting = UserSetting::where('fk_user',$user->id)
                        ->where("status",UserSetting::STATUS_SUCCESS)
                        ->where('key',$key)
                        ->orderBy('position')->get();
        $view = view('partials.setting-widgets.trading-type',compact('getUserSetting'))->render();
        return response($view);
    }
    

    public function sortSetting(Request $request){
        $request->validate([
            'key'=>"required",
            'value'=>"required|array",
        ]);
        $key = $request->get('key');
        $value = $request->get('value');
        UserSetting::validate($key,$value);
        $user = auth()->user();
        foreach ($value as $position => $id) {
            UserSetting::where('fk_user',$user->id)
                ->where('key',$key)
                ->where('id',$id)
                ->update([
                    "position"=>$position
                ]);
        }
        return response(["success"=>true]);
    }

    public function updateSetting(Request $request,$id){
        $request->validate([
            'key'=>"required",
            'value'=>"required",
        ]);
        $key = $request->get('key');
        $value = $request->get('value');
        $allKeys = [$key];
        if(strpos($key,"PAIR")!==false){
            $allKeys=UserSetting::ALL_PAIR_TYPES;
        }
        UserSetting::validate($key,$value);
        $user = auth()->user();
        UserSetting::where('id',$id)
        ->where('fk_user',$user->id)
        ->whereIn('key',$allKeys)
        ->update([
            "value"=>$value
        ]);
        return response(["success"=>true]);
    }

    public function deleteSetting(Request $request,$id){
        $request->validate([
            'key'=>"required"
        ]);
        $user = auth()->user();
        $allKeys = [$request->get('key')];
        UserSetting::validate($request->get('key'),"");
        if(strpos($request->get('key'),"PAIR")!==false){
            $allKeys=UserSetting::ALL_PAIR_TYPES;
        }
        UserSetting::where('id',$id)
        ->where('fk_user',$user->id)
        ->whereIn('key',$allKeys)
        ->delete();
        // return response(["success"=>true]);
        return redirect()->back()->with('message', 'Deleted successfully');
    }
    public function deleteAccount($id){
        $user = auth()->user();
        $getTrade = Trade::where('fk_account',$id)->first();
        if($getTrade)throwErrorMsg(translator("Sorry this account has order. So you cannot delete. Please contact support if you really need."));
        Account::where('fk_user',$user->id)
                    ->where('id',$id)->delete();
        return redirect()->back()->with('message', 'Deleted successfully');
    }
}
