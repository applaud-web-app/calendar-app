<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function calendars(){
        return $this->hasMany(Calendar::class,'category_id','id');
    }
}
