<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Common;

class CategoryController extends Controller
{
    public function allCategories(){
        $data['categories'] = Category::select('id','category_name')->where('status',1)->paginate(50);
        return view('admin.category.all-categories',$data);
    }

    public function updateCategory(Request $request){
        $request->validate([
            'category_name'=>'required',
        ]); 
        Category::where('id',$request->id)->update(['category_name'=>$request->category_name]);
        return redirect()->back()->with('success','Category updated successfully...');
    }   

    public function removeCategory(){
        $id = $this->memberObj['id'];
        Category::where('id',$id)->update(['status'=>2]);
        return redirect()->back()->with('success','Category removed successfully...');
    }

    public function removeUser(){
        $id = $this->memberObj['id'];
        User::where('id',$id)->delete();
        return redirect()->back()->with('success','User removed successfully...');
    }

    public function allUsers(){
        $data['users'] = User::where('u_type',2)->orderBy('created_at','DESC')->paginate(50);
        return view('admin.category.all-users',$data);
    }

    public function addUser(){
        return view('admin.category.add-user');
    }

    public function editCalendar(){
        $id = $this->memberObj['id'];
        $data['calendarData'] = Calendar::find($id);
        $inputObj = new \stdClass();
        $inputObj->params = 'id='.$id;
        $inputObj->url = url('admin/update-calendar');
        $data['encLink'] = Common::encryptLink($inputObj);
        return view('admin.category.edit-calendar',$data);
    }

    public function updateCalendar(Request $request){
        $request->validate([
            'calendar_name'=>'required',
            'category'=>'required',
            'access'=>'required'
        ]);
        $id = $this->memberObj['id'];
        $calendarObj = Calendar::find($id);
        $calendarObj->calendar_name = $request->calendar_name;
        $calendarObj->category_id = $request->category;
        $calendarObj->access_level = $request->access;
        $calendarObj->save();
        return redirect()->back()->with('success','Category updated successfully...');
    }

}
