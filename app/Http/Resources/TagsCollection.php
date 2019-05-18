<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TagsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $json_array = [];
        foreach ($this->collection->all() as $tag) {
            $json_array[] = $tag->tag;
        }
        return $json_array;
    }
}
