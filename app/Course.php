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
        'name', 'description', 'start', 'end', 'target_audience', 'host', 'location'
    ];
    public function participants()
    {
        return $this->belongsToMany('App\User', 'user_course', 'course_id', 'user_id');
    }

    public static $validation_rules = array(
        'name' => 'required|max:255',
        'description' => 'required|max:16000',
        'location' => 'required|max:255',
        'start' =>'required|date',
        'end' => 'required|date',
        'target_audience' => 'required|max:255',
        'host' => 'required|max:255'

    );

}
