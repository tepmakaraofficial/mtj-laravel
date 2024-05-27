<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumsCategory;

class ForumsCategoriesController extends Controller
{
    //Backend Start
    public function index(){
        $forumsCats = ForumsCategory::paginate(15);
        return view('backend.forums-categories.index',compact('forumsCats'));
    }
    public function create(){
        return view('backend.forums-categories.create');
    }
    public function add(Request $request){
        ForumsCategory::insert([
            'title'=>$request->get('title'),
            'tag'=>$request->get('tag'),
            'desc'=>$request->get('desc'),
            'status'=>$request->get('status'),
            'position'=>$request->get('position'),
            'parent_id'=>$request->get('parent_id')??null,
            'created_at' => getCurrentDatetime(),
            'updated_at' => getCurrentDatetime()
        ]);
        return redirect()->to("/admin/forums-categories")->with('message', 'Added successfully.');
    }
    public function save(Request $request,$id){
        ForumsCategory::where('id',$id)->update([
            'title'=>$request->get('title'),
            'tag'=>$request->get('tag'),
            'desc'=>$request->get('desc'),
            'status'=>$request->get('status'),
            'position'=>$request->get('position'),
            'parent_id'=>$request->get('parent_id')??null,
            'updated_at' => getCurrentDatetime()
        ]);
        return redirect()->to("/admin/forums-categories")->with('message', 'Updated successfully.');
    }
    public function delete($id){
        ForumsCategory::where('id',$id)->delete();
        return redirect()->to("/admin/forums-categories")->with('message', 'Delete successfully.');
    }
    public function edit($id){
        $getCat = ForumsCategory::where('id',$id)->first();
        return view('backend.forums-categories.edit',compact('getCat'));
    }
}
