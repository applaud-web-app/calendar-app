<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\CalendarEvent;
use App\Models\Category;
use Illuminate\Http\Request;
use Common;
class DashboardController extends Controller
{
    public function dashboard(){
        $data['calendarData'] = Category::with(['calendars'=>function($q){
            $q->select('id','category_id','calendar_name')->where(['access_level'=>1]);
        }])->where(['status'=>1])->paginate(20);
        return view('user.dashboard.dashboard',$data);
    }

    public function storeCategory(Request $request){
        $request->validate([
            'category_name'=>'required'
        ]);
        $catObj = new Category();
        $catObj->category_name = $request->category_name;
        $catObj->status = 1;
        $catObj->save();
        \Cache::forget('ACTIVE_CATEGORIES');
        return redirect('user/dashboard')->with('success','Category added successfully...');
    }

    public function addCalendar(){
        return view('user.dashboard.add-calendar');
    }

    public function storeCalendar(Request $request){
        $request->validate([
            'calendar_name'=>'required',
            'category'=>'required',
            'access'=>'required'
        ]);

        $calendarObj = new Calendar();
        $calendarObj->calendar_name = $request->calendar_name;
        $calendarObj->category_id = $request->category;
        $calendarObj->access_level = $request->access;
        $calendarObj->status = 1;
        $calendarObj->save();
        return redirect('user/add-calendar')->with('success','Calendar added successfully...');
    }

    public function monthlyCalendar(){
        $calendarId = $this->memberObj['id'];
        $startDate = date("Y-m-01");
        $endDate = date("Y-m-t");
        $data['monthDates'] = Common::getAllDates($startDate,$endDate);
        $calendarData = CalendarEvent::where('calendar_id',$calendarId)->whereBetween('event_date',[$startDate,$endDate])->get();
        $dateEvents = [];
        foreach($calendarData as $val){
            $dateEvents[$val->event_date][] = $val;
        }
        $data['dateEvents'] = $dateEvents;
        $data['calendarId'] = $calendarId;
        $data['monthName'] = date("F Y",strtotime($startDate));
        $data['prevDate'] = date("Y-m-d",strtotime('-1 month')); 
        $data['nextDate'] = date("Y-m-d",strtotime("+1 month"));
        $data['calendarD'] = Calendar::select('calendar_name')->find($calendarId);
        return view('user.dashboard.monthly-calendar',$data);
    }

    public function storeCalendarEvent(Request $request){
        $calendarId = $this->memberObj['id'];
        $eventObj = new CalendarEvent();
        $eventObj->color_code = $request->json('color_code');
        $eventObj->event_date = $request->json('event_date');
        $eventObj->event_title = $request->json('event_title');
        $eventObj->event_time = $request->json('event_time');
        $eventObj->calendar_id = $calendarId;
        $eventObj->save();
        return response()->json(['s'=>1]);
    }

    public function editCalendarEvent(){
        $id = $this->memberObj['id'];
        $data = CalendarEvent::find($id);
        $inputObjE = new \stdClass();
        $inputObjE->url = url('user/update-calendar-event');
        $inputObjE->params = 'id='.$id;
        $encLinkE = Common::encryptLink($inputObjE);
        $data->link = $encLinkE;
        return response()->json($data);
    }

    public function updateCalendarEvent(Request $request){
        $id = $this->memberObj['id'];
        $eventObj = CalendarEvent::find($id);
        $eventObj->color_code = $request->json('color_code');
        $eventObj->event_date = $request->json('event_date');
        $eventObj->event_title = $request->json('event_title');
        $eventObj->event_time = $request->json('event_time');
        $eventObj->save();
        return response()->json(['s'=>1]);
    }

    public function getCalendarMonthData(Request $request){
        $date = $request->json('date');
        $calendarId = $this->memberObj['id'];
        $startDate = date("Y-m-01",strtotime($date));
        $endDate = date("Y-m-t",strtotime($date));
        $data['monthDates'] = Common::getAllDates($startDate,$endDate);
        $calendarData = CalendarEvent::where('calendar_id',$calendarId)->get();
        $dateEvents = [];
        foreach($calendarData as $val){
            $dateEvents[$val->event_date][] = $val;
        }
        $data['dateEvents'] = $dateEvents;
        $data['calendarId'] = $calendarId;
        $data['monthName'] = date("F Y",strtotime($startDate));
        $data['prevDate'] = date("Y-m-d",strtotime($date.' -1 month')); 
        $data['nextDate'] = date("Y-m-d",strtotime($date." +1 month"));
        $data['calendarD'] = Calendar::select('calendar_name')->find($calendarId);
        return view('user.dashboard.monthly-calendar-ajax',$data);
    }

    public function threeMonthlyCalendar(){
        $calendarId = $this->memberObj['id'];
        $data['calendarId'] = $calendarId;
        $data['calendarD'] = Calendar::select('calendar_name')->find($calendarId);

        $firstMonth = date("Y-m-01");
        $secondMonth = date("Y-m-01",strtotime('+1 months'));
        $thirdMonth = date("Y-m-01",strtotime('+2 months'));
        $endDate = date("Y-m-t",strtotime($thirdMonth));
        $calendarData = CalendarEvent::where('calendar_id',$calendarId)->whereBetween('event_date',[$firstMonth,$endDate])->get();
        $dateEvents = [];
        foreach($calendarData as $val){
            $dateEvents[$val->event_date][] = $val;
        }
        $data['dateEvents'] = $dateEvents;
        $data['firstMonthName'] = date("F Y",strtotime($firstMonth));
        $data['secondMonthName'] = date("F Y",strtotime($secondMonth));
        $data['thirdMonthName'] = date("F Y",strtotime($thirdMonth));

        $data['firstMonthDates'] = Common::getAllDates($firstMonth,date("Y-m-t",strtotime($firstMonth)));
        $data['secondMonthDates'] = Common::getAllDates($secondMonth,date("Y-m-t",strtotime($secondMonth)));
        $data['thirdMonthDates'] = Common::getAllDates($thirdMonth,date("Y-m-t",strtotime($thirdMonth)));

        $data['prevDate'] = date("Y-m-d",strtotime('-3 months'));
        $data['nextDate'] = date("Y-m-d",strtotime('+3 months'));
        return view('user.dashboard.three-monthly-calendar',$data);
    }

    public function getCalendarThreeMonthData(Request $request){
        $date = $request->json('date');
        $calendarId = $this->memberObj['id'];
        $firstMonth = date("Y-m-01",strtotime($date));
        $secondMonth = date("Y-m-01",strtotime($date.'+1 months'));
        $thirdMonth = date("Y-m-01",strtotime($date.'+2 months'));
        $endDate = date("Y-m-t",strtotime($thirdMonth));
        $calendarData = CalendarEvent::where('calendar_id',$calendarId)->whereBetween('event_date',[$firstMonth,$endDate])->get();
        $dateEvents = [];
        foreach($calendarData as $val){
            $dateEvents[$val->event_date][] = $val;
        }
        $data['dateEvents'] = $dateEvents;
        $data['firstMonthName'] = date("F Y",strtotime($firstMonth));
        $data['secondMonthName'] = date("F Y",strtotime($secondMonth));
        $data['thirdMonthName'] = date("F Y",strtotime($thirdMonth));

        $data['firstMonthDates'] = Common::getAllDates($firstMonth,date("Y-m-t",strtotime($firstMonth)));
        $data['secondMonthDates'] = Common::getAllDates($secondMonth,date("Y-m-t",strtotime($secondMonth)));
        $data['thirdMonthDates'] = Common::getAllDates($thirdMonth,date("Y-m-t",strtotime($thirdMonth)));

        $data['prevDate'] = date("Y-m-d",strtotime($date.'-3 months'));
        $data['nextDate'] = date("Y-m-d",strtotime($date.'+3 months'));
        return view('user.dashboard.three-monthly-calendar-ajax',$data);
    }

    public function yearlyCalendar(Request $request){
        $calendarId = $this->memberObj['id'];
        $data['calendarId'] = $calendarId;
        $data['calendarD'] = Calendar::select('calendar_name')->find($calendarId);
        if($request->isMethod('post')){
            $startDate = date("Y-m-d",strtotime($request->start));
            $endDate = date("Y-m-d",strtotime($request->end));
            $calendarData = CalendarEvent::where('calendar_id',$calendarId)->whereBetween('event_date',[$startDate,$endDate])->get();
            $dateEvents = [];
            foreach($calendarData as $val){
                $dateEvents[] = [
                    'title'=>$val->event_title.Common::timeFormatGlYr($val->event_time),
                    'start'=>$val->event_date,
                    'end'=>$val->event_date,
                ];
            }
            return response()->json($dateEvents);
        }
        return view('user.dashboard.yearly-calendar',$data);
    }

}
