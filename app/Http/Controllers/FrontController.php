<?php

namespace App\Http\Controllers;

use App\Models\Trade;
use App\Models\Account;
use Illuminate\View\View;
use App\Models\UserSetting;
use App\Models\MistakeNotes;
use Illuminate\Http\Request;

class FrontController extends Controller
{

    function home(){
        $user = auth()->user();
        $getUserSetting = UserSetting::where('fk_user',$user->id)
                    ->where("status",UserSetting::STATUS_SUCCESS)
                    ->whereIn("key",["TRADING_TYPE"])
                    ->orderBy('position')->get();

        return view('home',compact('getUserSetting'));
    }

    function myProfile() : View {
        $user = auth()->user();
        return view('myprofile',compact('user'));
    }

    function updateMyProfile(Request $request) : View {
        $user = auth()->user();
        $user->name = $request->get('name');
        $user->save();
        return view('myprofile',compact('user'));
    }
    
    

    function fromMenus(Request $request, $slug){
        switch ($slug) {
            case 'news':
                return (new NewsController)->home($request);
                break;
            case 'motivation':
                return (new MotivationController)->home($request);
                break;
            case 'learn':
                return (new LearnController)->home($request);
                break;
            case 'privacy-policy':
                return view('privacypolicy');
                break;
            case 'term-of-service':
                return view('termofservice');
                break;
            case 'disclaimer':
                return view('disclaimer');
                break;
            case 'about-us':
                return view('about-us');
                break;
            case 'contact-us':
                return view('contact-us');
                break;
            
        }
        return view('home');
    }

    function pinMessage(){
        $user = auth()->user();
        $datas = [];
        $mistakeNotes = MistakeNotes::where("fk_user",$user->id)->orderBy('level','DESC')->where('action',3)->orderBy('created_at','DESC')->get();
        foreach ($mistakeNotes as $key => $value) {
            $datas[]=[
                "title"=>$value->title,
                "url"=>"trade/mistake-notes/view-edit/".$value->id,
            ];
        }
        return view('pin-message',compact('datas'));
    }

}
