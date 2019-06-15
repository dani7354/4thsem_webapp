<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TagsCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagsController extends Controller
{


    /**
     * @OA\Get(
     *     path="/tags",
     *     tags={"tags"},
     *     summary="Returns all tags",
     *     description="All tags as JSON collection",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *
     *          )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(new TagsCollection(Tag::all()), 200);
    }


}
