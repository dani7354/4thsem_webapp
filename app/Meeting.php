<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $fillable = [
        'host',
        'name',
        'location',
        'description',
        'start',
        'end'

    ];


    public static $validation_rules = array(
        'name' => 'required',
        'description' => 'required',
        'host' => 'required',
        'location' => 'required',
        'start' => 'required',
        'end' => 'required',

    );


}
