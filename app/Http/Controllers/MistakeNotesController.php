<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\MistakeNotes;
use Illuminate\Http\Request;

class MistakeNotesController extends Controller
{
    function mistakeNotes(Request $request) : View {
        $user = auth()->user();
        $level = $request->get('level');
        $search = $request->get('search');
        $mistakeNotes = MistakeNotes::where("fk_user",$user->id)
        ->when(!empty($search),function($q) use($search){
            $q->where('title','LIKE',"%$search%");
        })
        ->when(!empty($level) && $level!='all',function($q) use($level){
            $q->where('level',$level);
        })
        ->orderBy('level','DESC')->orderBy('created_at','DESC')
        ->paginate(5);
        return view('home',compact('mistakeNotes'));
    }
    function createMistakeNotes(Request $request){
        $user = auth()->user();
        if(empty($request->get('title'))){
            throwErrorMsg("Title is required");
        }
        if(empty($request->get('desc'))){
            throwErrorMsg("Description is required");
        }
        if(!isset(MistakeNotes::ALL_LEVELS[$request->get('level')])){
            throwErrorMsg("Invalid level");
        }
        if($request->has('action')&&!isset(MistakeNotes::ALL_ACTIONS[$request->get('action')])){
            throwErrorMsg("Invalid action");
        }
        MistakeNotes::insert([
            "title"=>$request->get('title'),
            "desc"=>$request->get('desc'),
            "level"=>$request->get('level'),
            "action"=>1,
            "fk_user"=>$user->id,
            "created_at"=>getCurrentDatetime(),
            "updated_at"=>getCurrentDatetime()
        ]);
        return redirect()->back()->with('message', 'Added successfully.');
    }
    function viewEdit(Request $request, $id){
        $user = auth()->user();
        $mistakeNote = MistakeNotes::where('fk_user',$user->id)
                        ->where('id',$id)->first();
        return view('home',compact('mistakeNote'));
    }
    function delete(Request $request, $id){
        $user = auth()->user();
        $mistakeNote = MistakeNotes::where('fk_user',$user->id)
                        ->where('id',$id)->delete();
        return redirect()->to('/trade/mistake-notes')->with('message', 'Delete successfully.');
    }
    function update(Request $request, $id){
        $user = auth()->user();
        if(empty($request->get('title'))){
            throwErrorMsg("Title is required");
        }
        if(empty($request->get('desc'))){
            throwErrorMsg("Description is required");
        }
        if(!isset(MistakeNotes::ALL_LEVELS[$request->get('level')])){
            throwErrorMsg("Invalid level");
        }
        if($request->has('action')&&!isset(MistakeNotes::ALL_ACTIONS[$request->get('action')])){
            throwErrorMsg("Invalid action");
        }
        MistakeNotes::where('fk_user',$user->id)
                        ->where('id',$id)
                        ->update([
                            "title"=>$request->get('title'),
                            "desc"=>$request->get('desc'),
                            "level"=>$request->get('level')
                        ]);
        return redirect()->back()->with('message', 'Updated successfully.');
    }

    public function updateAction(Request $request, $id){
        $user = auth()->user();
        MistakeNotes::where('fk_user',$user->id)
        ->where('id',$id)->update(['action'=>$request->get('action')]);
        return response(["success"=>true]);
    }
    
}
