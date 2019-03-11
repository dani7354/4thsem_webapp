<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Course;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Article::get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_user = User::find(Auth::user()->id);
        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Article::$validation_rules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $article = new Article();
            $article->title = $request['title'];
            $article->content = $request['content'];
            $article->tags = $request['tags'];
            $article->date_created = now();
            $article->user_id = 1; //TODO: change this shit!
            $article->save();

            return response()->json($article, 201);
        }
        else{
            return response()->json(null, 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return is_null($article) ? response()->json(null, 404) : response($article, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $current_user = User::find(Auth::user()->id);
        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Article::$validation_rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $article->update($request->all());
            return response()->json($article, 200);
        }
        else{
            return response()->json(null, 403);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $current_user = User::find(Auth::user()->id);
        if($current_user->hasRole('Admin')) {
            $article = Article::find($id);
            if (is_null($article)) {
                return response()->json(null, 404);
            }
            $article->delete();
            return response()->json(null, 204);
        }
        else{
            return response()->json(null, 403);
        }
    }

    public function get_by_tag($tag)
    {
        $articles = Article::where('tags', 'LIKE', '%' . $tag . '%')->get();
        return response()->json($articles, 200);

    }
}
