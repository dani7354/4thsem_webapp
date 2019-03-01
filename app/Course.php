<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;


class Course extends Model
{
    public static $validation_rules = array(
        'name' => 'required',
        'description' => 'required',
        'start' =>'required',
        'end' => 'required',

    );
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

}
