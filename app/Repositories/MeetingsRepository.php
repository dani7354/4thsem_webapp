<?php


namespace App\Repositories;

use App\Meeting;
use App\Repositories\Eloquent;

class MeetingsRepository extends Eloquent\Repository
{
    public function model()
    {
        return new Meeting();
    }

}