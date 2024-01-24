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

    public function forgetPassword(){
        return view("index.forget-password");
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email'
        ]);
        $checkEmail = User::where(['email'=>$request->email,'u_status'=>1])->where('u_type','!=',1)->first();
        
        if(!$checkEmail){
            return redirect('forget-password')->with('error','Enter registered email account to reset your password');
        }
        $token = str_shuffle('abcdefghijklmnopqrstuvwxyz1234567890');
        $data = [
            'email'=>$request->email,
            'token'=>$token,
            'user'=>$checkEmail
        ];
        \Mail::send('index.send-reset-link', $data, function($message) use($data) {
            $message->to($data['email'], 'CalendarApp')->subject
                ('Password Reset Link - '.date("d M Y h:i A"));
        });
        return redirect('forget-password')->with('success','Password reset link sent your email successfully...');
    }
    
}
