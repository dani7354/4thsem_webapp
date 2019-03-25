<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;


class Course extends Model
{
   protected $hidden = [
     'created_at', 'updated_at'
   ];
    protected $fillable = [
        'name', 'description', 'start', 'end', 'user_id', 'location'
    ];
    public function participants()
    {
        return $this->belongsToMany('App\User', 'user_course', 'course_id', 'user_id');
    }
    public function host(){
       return $this->belongsTo(User::class);
    }
    public static $validation_rules = array(
        'name' => 'required',
        'description' => 'required',
        'location' => 'required',
        'start' =>'required',
        'end' => 'required',

    );

}
