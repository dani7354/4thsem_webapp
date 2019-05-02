<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        $json_array = [];
        foreach ($this->collection->all() as $article) {
            $json_array[] = [
                'id' => $article->id,
                'title' => $article->title,
                'content' => $article->content,
                'date_created' => $article->date_created,
                'author' => $article->author,
                'tags' => $article->tags->transform(function ($tag) {
                    return $tag['tag'];
                })
            ];
        }
        return $json_array;

    }
}
