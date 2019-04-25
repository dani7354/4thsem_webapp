<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article as ArticleResource;
use App\Repositories\ArticlesRepository as ArticlesRepo;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{

    public function __construct(ArticlesRepo $articles)
    {
        $this->articles_repo = $articles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json($this->articles_repo->all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
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
            $article = $this->articles_repo->create($request->all());

            $this->save_tags($request['tags'], $article);



            return response()->json(null, 201);
        }
        else{
            return response()->json(null, 403);
        }
    }

    private function save_tags(string $tags, Article $article)
    {
        $tags_arr = explode('#', $tags);

        foreach ($tags_arr as $tag) {
            $found_tag = Tag::where('tag', strtolower($tag))->first();
            if (is_null($found_tag)) {
                $found_tag = Tag::create(['tag' => $tag]);
                $found_tag->save();
            }

            $article->tags()->attach($found_tag->id);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $article = $this->articles_repo->find($id);
        return is_null($article) ? response()->json(null, 404) : response(new ArticleResource($article), 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Article $article
     * @return Response
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
     * @return Response
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
