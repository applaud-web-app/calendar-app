<?php

namespace App\Helpers;
class Common
{
  public static function encryptLink($inputObj){
    $params = isset($inputObj->params) ? $inputObj->params : '';
    $url = url($inputObj->url);
    if($params!=''){
      $link = $url.'?eq='.urlencode(\Crypt::encrypt($inputObj->params));
      return $link;
    }
    return $url;
  }

  public static function decryptLink($input){
    $decrString = urldecode(\Crypt::decrypt($input));
    $reqArr = [];
    if(strpos($decrString,"=")!==false){
      $keyVal = explode("&",$decrString);
      if(count($keyVal) > 0){
        foreach($keyVal as $v):
          $kvarr = explode("=",$v);
          if(count($kvarr)>0){
            $reqArr[$kvarr[0]] = $kvarr[1];
          }
        endforeach;
      }
    }
    return $reqArr;
  }

  public static function allCategories(){
    $data = \Cache::rememberForever('ACTIVE_CATEGORIES', function () {
        $categories = \App\Models\Category::select('id','category_name')->where('status',1)->get();
        return $categories;
    });
    return $data;
  }

  public static function getAllDates($date1,$date2){
    $period = new \DatePeriod(
      new \DateTime($date1),
      new \DateInterval('P1D'),
      new \DateTime($date2.' +1 day')
    );
    $finalArr = [];
    foreach ($period as $value) {
        $finalArr[] = [
          'date'=>$value->format('Y-m-d'),
          'format_date'=>$value->format('d M')
        ];    
    }
    return json_decode (json_encode ($finalArr),FALSE);
  }

  public static function timeFormatGl($time){
    if(is_null($time)){
      return '';
    }
     $today = date("Y-m-d");
     return date("h:i A",strtotime($today.' '.$time));
  }

}
