<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public static $validation_rules = array(
        'name' => 'required',
        'description' => 'required',
        'start' =>'required',
        'end' => 'required',
        'user_id' => 'required'

    );
    protected $fillable = [
        'name', 'description', 'start', 'end', 'user_id',
    ];
    public function participants(){
        $this->belongsToMany(User::class);
    }
    public function host(){
        $this->belongsTo(User::class);
    }

}
