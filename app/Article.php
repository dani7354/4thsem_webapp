<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function author(){
        $this->belongsTo(User::class, 'user_id');
    }
}
