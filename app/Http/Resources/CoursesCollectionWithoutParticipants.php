<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoursesCollectionWithoutParticipants extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'host' => new User($this->host),
            'location' = $this->location,
            'start' => $this->start,
            'end' => $this->end,
            'participants' =>
        ];




    }
}
