<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Course extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'location' => $this ->location,
            'start' => $this->start,
            'end' => $this->end,
            'participants' =>  $this->participants,

        );
    }
}
