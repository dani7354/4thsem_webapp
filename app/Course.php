<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function participants(){
        $this->belongsToMany(User::class);
    }
    public function host(){
        $this->belongsTo(User::class);
    }

}
