<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){

        if(!empty($request->get('data'))){
            return $this->loginFromExternal($request);
        }
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
 
        $credentials['role_id'] = $this->getRoleId('trader');
        if (Auth::guard('web')->attempt($credentials,$request->has('remember'))) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'username' => 'credential_not_match',
        ])->onlyInput('username');
    }

    public function loginFromExternal(Request $request){
        $timeZone = $request->get('timeZone');
        $userData = json_decode($request->get('data'));
        // dd($userData);
        $uId = $userData->uid??null;
        if(empty($uId)){
            return back()->withErrors([
                'username' => 'credential_not_match',
            ])->onlyInput('username');
        }

        $getUser = \DB::table('users')->where('uid',$uId)->first();
        if($getUser){
            $credentials = [
                'role_id'=>$this->getRoleId('trader'),
                'password'=>$uId,
                'uid'=>$uId
            ];
            if (Auth::guard('web')->attempt($credentials,true)) {
               
                $request->session()->regenerate();
                \DB::table('users')->where('uid',$uId)->update(['time_zone'=>$timeZone]);
                return redirect()->intended('/');
            }
            return response("Something went wrong");
            // return back()->withErrors([
            //     'username' => 'credential_not_match',
            // ])->onlyInput('username');
        }else{
            $userId = \DB::table('users')->insertGetId([
                'role_id'=>$this->getRoleId('trader'),
                'uid'=>$uId,
                'time_zone'=>$timeZone,
                'name'=>$userData->displayName,
                'avatar'=>$userData->photoURL,
                'email'=>'trader-'.$userData->email??'',
                'password'=>Hash::make($uId),
                'created_at'=>getCurrentDatetime(),
                'updated_at'=>getCurrentDatetime(),
            ]);
            if (Auth::loginUsingId($userId)) {
                $request->session()->regenerate();
     
                return redirect()->intended('/');
            }
            return back()->withErrors([
                'username' => 'credential_not_match',
            ])->onlyInput('username');
        }
    }

    public function getRoleId($roleName) : int {
        $getRoleId = \DB::table("roles")->where("name",$roleName)->first()->id;
        return $getRoleId;
    }

    public function logout(){
        Auth::logout();
        return view('logout');
        return redirect()->intended('/');
    }

    function loginPage() : View {
        return view('login');
    }

    public function redirect(Request $request){
        dd($request);
        return view('learn');
    }
}
