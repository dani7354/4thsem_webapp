<?php
/**
 * Created by PhpStorm.
 * User: d
 * Date: 2019-03-28
 * Time: 09:19
 */

namespace App\Repositories;

use App\Repositories\Eloquent\Repository;


class CoursesRepository extends Repository
{

    function model()
    {
        return 'App\Course';
    }


}