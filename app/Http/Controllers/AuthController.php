<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function login(){
        if(Auth::check()){
            if(Auth::user()->u_type==1){
                return redirect('admin/dashboard');
            }
            return redirect("user/dashboard");
        }
        return view('auth.login');
    }

    public function checkLogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $rememberMe = !empty($request->remember_me) ? $request->remember_me : 0;
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$rememberMe)){
            if(Auth::user()->u_status!=1){
                Auth::logout();
                return redirect('/')->with('warning','Account is deactivated..contact admin for more info...');
            }
            if(Auth::user()->u_type==1){
                return redirect('admin/dashboard');
            }
            return redirect("user/dashboard");
        }
        return redirect('/')->with('warning','Invalid login credentials..');
    }

    public function register(){
        return view('auth.register');
    }
    
    public function storeRegister(Request $request){
        $request->validate([
            'full_name'=>'required',
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $checkEmail = User::where('email',$request->email)->count();
        if($checkEmail){
            return redirect('/register')->with('warning','Email already exists..');
        }
        $userObj = new User();
        $userObj->email = $request->email;
        $userObj->name = $request->full_name;
        $userObj->password = Hash::make($request->password);
        $userObj->u_status = 1;
        $userObj->u_type = 2;
        $userObj->save();
        return redirect('/')->with('success','Account created successfully..Login to continue');
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
