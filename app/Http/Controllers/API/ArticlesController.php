<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\User;
use App\Repositories\ArticlesRepository as ArticlesRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Course;

class ArticlesController extends Controller
{

    public function __construct(ArticlesRepo $articles)
    {
        $this->articles_repo = $articles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->articles_repo->all(), 200);
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
            $request['user_id'] = $current_user->id;
            $this->articles_repo->create($request->all());

            return response()->json(null, 201);
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
        $article = $this->articles_repo->find($id);
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
            $this->articles_repo->update($request['id'], $request->all());
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
            $article = $this->articles_repo->find($id);
            if (is_null($article)) {
                return response()->json(null, 404);
            }
            $this->articles_repo->delete($id);
            return response()->json(null, 204);
        }
        else{
            return response()->json(null, 403);
        }
    }

   /* public function get_by_tag($tag)
    {
        $articles = Article::where('tags', 'LIKE', '%' . $tag . '%')->get();
        return response()->json($articles, 200);

    }*/
}
