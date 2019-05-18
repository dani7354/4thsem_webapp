<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\TagsCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(new TagsCollection(Tag::all()), 200);
    }


}
