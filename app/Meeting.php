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
        'name' => 'required|max:255',
        'description' => 'required|max:16000',
        'host' => 'required|max:255',
        'location' => 'required|max:255',
        'start' => 'required|date',
        'end' => 'required|date',

    );


}
