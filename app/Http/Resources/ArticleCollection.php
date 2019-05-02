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
        return [
            $this->collection->transform(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'content' => $article->content,
                    'date_created' => $article->date_created,
                    'author' => $article->author,
                    'tags' => $article->tags
                ];

            })

        ];

    }
}
