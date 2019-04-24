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
        'description',
        'start',
        'end'

    ];


}
