<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{


    protected $fillable = array(
        'title', 'content', 'tags'
    );

    public function author(){
        $this->belongsTo(User::class, 'user_id');
    }
    public static  $validation_rules = array(
        'title' => 'required',
        'content' => 'required',
    );
}
