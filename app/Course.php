<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
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
