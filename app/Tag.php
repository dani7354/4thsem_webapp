<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $hidden = [
        'pivot'

    ];

    protected $fillable = [
        'tag'
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag');
    }

    public $timestamps = false;

}
