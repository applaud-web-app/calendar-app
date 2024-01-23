<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
class IndexController extends Controller
{
    public function privacyPolicy(){
        return view('index.privacy-policy');
    }
    
    public function termsAndCondition(){
        return view('index.terms-and-condition');
    }
    
    public function contactUs(){
        return view('index.contact-us');
    }

    public function storeContact(Request $request){
        $request->validate([
            'full_name'=>'required',
            'subject'=>'required',
            'phone_no'=>'required',
            'email'=>'required',
            'massage'=>'required',
        ]);
        $contact = new Enquiry();
        $contact->full_name = $request->full_name;
        $contact->subject = $request->subject;
        $contact->phone_number = $request->phone_no;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();
        return redirect('contact-us')->with('success','Message sent successfully...Thank you for contacting us..We will respond to you soon.');
    }

    public function myProfile(){
        return view('index.my-profile');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'full_name'=>'required',
            'email'=>'required|email'
        ]);

        $checkEmail = User::where('email',$request->email)->where('id','!=',Auth::id())->count();
        if($checkEmail){
            return redirect('my-profile')->with('error','Email already exists');
        }

        User::where('id',Auth::id())->update([
            'name'=>$request->full_name,
            'email'=>$request->email
        ]);
        return redirect('my-profile')->with('success','Profile updated successfully...');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'new_password'=>'required',
            'confirm_Password'=>'required|same:new_password'
        ]);
        User::where('id',Auth::id())->update([
            'password'=>Hash::make($request->new_password),
        ]);
        return redirect('my-profile')->with('success','Password updated successfully...');
    }
}
