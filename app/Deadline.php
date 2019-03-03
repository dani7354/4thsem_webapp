<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    protected $fillable = array(
        "name", "description", "date"
    );

    public static $validation_rules = array(
       'name' => 'required',
        'date' => 'required'

    );
}
