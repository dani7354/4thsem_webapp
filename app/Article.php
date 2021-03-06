<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    protected $hidden = [
        'created_at', 'updated_at'
    ];
    protected $fillable = array(
        'title', 'content'
    );

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public static  $validation_rules = array(
        'title' => 'required|max:255',
        'content' => 'required|max:16000',

    );
}
