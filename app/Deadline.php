<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{

    protected $hidden = [
        'created_at', 'updated_at',
    ];
    protected $fillable = array(
        "name", "description", "date"
    );

    public static $validation_rules = array(
       'name' => 'required',
        'date' => 'required'

    );
}
