<?php
/**
 * Created by PhpStorm.
 * User: d
 * Date: 2019-03-28
 * Time: 17:19
 */

namespace App\Repositories;
use App\Repositories\Eloquent\Repository;
use App\Article;


class ArticlesRepository extends Repository
{
    public function model()
    {
        return new Article();
    }

}