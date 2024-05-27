<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'name'=>"required",
            'balance'=>"required",
            'ccy'=>"required",
            'trading_type'=>"required",
            'status'=>"required",
        ]);
        $name = $request->get('name');
        $balance = $request->get('balance');
        $ccy = $request->get('ccy');
        $remark = $request->get('remark');
        $trading_type = $request->get('trading_type');
        $status = $request->get('status');
        $id = $request->get('id');
        $user = auth()->user();
        if(!isset(\App\Models\Trade::getTradingType()[$trading_type])){
            throwErrorMsg(translator("Invalid trading type please try again."));
        }
        if(!empty($id)){
            Account::where('fk_user',$user->id)
                ->where('id',$id)
                ->update([
                'name'=>$name,
                'balance'=>$balance,
                'ccy'=>$ccy,
                'remark'=>$remark,
                'trading_type'=>$trading_type,
                'status'=>$status,
                'updated_at'=>getCurrentDatetime(),
            ]);
            return response(["success"=>true]);
        }
        Account::insert([
            'fk_user'=>$user->id,
            'name'=>$name,
            'balance'=>$balance,
            'ccy'=>$ccy,
            'remark'=>$remark,
            'trading_type'=>$trading_type,
            'status'=>$status,
            'created_at'=>getCurrentDatetime(),
            'updated_at'=>getCurrentDatetime(),
        ]);
        return response(["success"=>true]);
    }

    public function find(Request $request,$id){
        return response(Account::find($id));
    }
}
