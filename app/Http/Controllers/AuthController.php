<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetToken;
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
        if(Auth::check()){
            return redirect('admin/all-users')->with('success','Account created successfully..');
        }
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

        PasswordResetToken::where(['email'=>$request->email])->delete();

        PasswordResetToken::insert([
            'email'=>$request->email,
            'token'=>$token
        ]);

        \Mail::send('index.send-reset-link', $data, function($message) use($data) {
            $message->to($data['email'], 'CalendarApp')->subject
                ('Password Reset Link - '.date("d M Y h:i A"));
        });
        return redirect('forget-password')->with('success','Password reset link sent your email successfully...');
    }
    
    public function resetPassword(Request $request){
        $email = $request->email;
        $token = $request->token;
        $checkValid = PasswordResetToken::where(['email'=>$email,'token'=>$token])->first();
        if(!$checkValid){
            return redirect('forget-password')->with('error','Invalid link or link expired...');
        }
        return view('index.reset-password');
    }

    public function storeResetPassword(Request $request){
        $request->validate([
            'password'=>'required'
        ]);
        $email = $request->email;
        $token = $request->token;
        $checkValid = PasswordResetToken::where(['email'=>$email,'token'=>$token])->first();
        if(!$checkValid){
            return redirect('forget-password')->with('error','Invalid link or link expired...');
        }
        PasswordResetToken::where('email',$checkValid->email)->delete();
        User::where('email',$email)->update(['password'=>Hash::make($request->password)]);
        return redirect('/')->with('success','Password changed successfully..Login to continue');

    }
}
