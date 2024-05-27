<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Motivation;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function updateOrAdd(Request $request){
        $user = auth()->user();
        $request->validate([
            'type'=>"required",
            'type_id'=>"required",
        ]);
        $getLike = Like::where('fk_user',$user->id)
                    ->where('type',$request->get('type'))
                    ->where('type_id',$request->get('type_id'))
                    ->first();
        if($getLike){
            $liked = $getLike->liked==1?0:1;
            Like::where('id',$getLike->id)
                    ->update([
                        "liked"=>$liked,
                        "updated_at"=>getCurrentDatetime()
                    ]);
        }else{
            Like::insert([
                "type"=>$request->get('type'),
                "type_id"=>$request->get('type_id'),
                "liked"=>1,
                'fk_user'=>$user->id,
                'created_at' => getCurrentDatetime(),
                'updated_at' => getCurrentDatetime()
            ]);
        }
        if($request->get('type')==Like::TYPE_MOTIVATION){
            Motivation::where('id',$request->get('type_id'))
                    ->update([
                        'like'=>Like::where('type',$request->get('type'))
                        ->where('liked',1)->select('id')
                        ->where('type_id',$request->get('type_id'))->count(),
                        "updated_at"=>getCurrentDatetime()
                    ]);
        }
        return response(["success"=>true]);
    }
}
