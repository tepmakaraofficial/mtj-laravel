<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Motivation;
use Illuminate\Http\Request;

class MotivationController extends Controller
{
    public function home(){
        $user = auth()->user();
        $motivations = Motivation::select(\DB::raw("(SELECT l.liked FROM likes AS l WHERE l.type=".Like::TYPE_MOTIVATION." 
        AND l.type_id=motivations.id AND l.fk_user=".$user->id." LIMIT 1) AS liked"),"motivations.*"
        )->orderBy("motivations.like","DESC")->orderBy("motivations.id","DESC")
        ->paginate(15);
        return view('motivation',compact('motivations'));
    }
    public function view($id){
        $view = view('partials.motivation-view',compact('id'))->render();
        return response($view);
    }

    //Backend Start
    public function index(){
        $motivations = Motivation::paginate(15);
        return view('backend.motivations.index',compact('motivations'))->render();
    }
    public function create(){
        return view('backend.motivations.create')->render();
    }
    public function add(Request $request){
        Motivation::insert([
            'title'=>$request->get('title'),
            'type'=>$request->get('type'),
            'content'=>$request->get('content'),
            'status'=>$request->get('status'),
            'created_at' => getCurrentDatetime(),
            'updated_at' => getCurrentDatetime()
        ]);
        return redirect()->to("/admin/motivations")->with('message', 'Added successfully.');
    }
}
