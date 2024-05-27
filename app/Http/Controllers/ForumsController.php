<?php

namespace App\Http\Controllers;

use App\Models\ForumsChat;
use Illuminate\Http\Request;
use App\Models\ForumsCategory;
use Illuminate\Support\Facades\DB;

class ForumsController extends Controller
{
    public function home(){
        $forumsCats = ForumsCategory::where('status',1)->paginate(15);
        return view('forums.index',compact('forumsCats'));
    }

    public function detail(Request $request, $id){
        $forumsCat = ForumsCategory::find($id);
        $forumsChats = ForumsChat::with('user','parent')->where('status',1)->where('fk_cat',$id)->orderBy('id','DESC')->paginate(5);
        return view('forums.detail',compact('forumsChats','forumsCat'));
    }

    public function latest(){
        $forumsLatests = ForumsChat::with('user','cat')->where('status',1)->orderBy('id','DESC')->limit(6)->get();
        return view('partials.forums.latest',compact('forumsLatests'))->render();
    }

    public function pop(){
        $forumsPop = ForumsCategory::where('status',1)
                        ->select("*")
                        ->addSelect(DB::raw('(SELECT SUM(c.id) FROM forums_chats AS c WHERE c.fk_cat=forums_categories.id) AS total_commet'))
                        ->whereRaw('(SELECT c.id FROM forums_chats AS c WHERE c.fk_cat=forums_categories.id LIMIT 1) IS NOT NULL')
                        ->orderBy('total_commet','DESC')->limit(6)->get();
        return view('partials.forums.pop',compact('forumsPop'))->render();
    }

    public function postForm($id){
        $forumsChat = ForumsChat::where('id',$id)->first();
        return view('forums.comment-form',compact('forumsChat'))->render();
    }
    public function post(Request $request){
        $request->validate([
            'post'=>'required',
            'cat_id'=>'required',
        ]);
        $getCat = ForumsCategory::where('id',$request->get('cat_id'))->first();
        if(!$getCat) throwErrorMsg("Invalid cat ID");
        $user = auth()->user();
        ForumsChat::insert([
            'post'=>$request->get('post'),
            'fk_cat'=>$getCat->id,
            'parent_id'=>!empty($request->get('parent_id'))?$request->get('parent_id'):null,
            'fk_user'=>$user->id,
            'created_at'=>getCurrentDatetime(),
            'updated_at'=>getCurrentDatetime(),
        ]);
        return redirect()->to('/forums/'.$request->get('cat_id'))->with('message', 'Post successfully.');
    }
}
