<?php
/**
 * Created by PhpStorm.
 * User: d
 * Date: 2019-03-28
 * Time: 17:19
 */

namespace App\Repositories;
use App\Article;
use App\Repositories\Eloquent\Repository;


class ArticlesRepository extends Repository
{
    public function model()
    {
        return new Article();
    }
    public function create(array $data)
    {
        $article = new Article();
        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->date_created = now();
        $article->user_id = $data['user_id'];
        $article->save();
        return $article;



    }


}