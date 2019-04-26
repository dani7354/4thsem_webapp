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

    public function get_by_tag(Request $request)
    {
        $tag = Tag::where('tag', $request['tag'])->first();
        if (!$tag) {
            return response()->json("tag not found: " . $request['tag'], 404);
        }
        $articles = $tag->articles()->get();

        return response()->json($articles, 200);
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


            if (!empty($request['tags'])) {

                $this->save_tags($this->split_tags_to_array($request['tags']), $article);
            }

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
            $article->title = $request['title'];
            $article->content = $request['content'];
            $this->update_tags($request['tags'], $article);


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

    // Helper methods for saving and updating tags


    private function split_tags_to_array(string $tags)
    {
        $tags_arr = explode('#', $tags);
        $tags_arr = array_map('strtolower', $tags_arr);
        $tags_arr = array_map('trim', $tags_arr);
        return $tags_arr;

    }

    private function update_tags($tags, Article $article)
    {
        $tags = $tags ?? ""; // if the request has no tags.
        $tags_arr = $this->split_tags_to_array($tags);
        $this->save_tags($tags_arr, $article);
        $this->remove_tags($tags_arr, $article);

    }

    private function save_tags(array $tags_arr, Article $article)
    {

        foreach ($tags_arr as $tag) {
            if (!empty($tag) && !$article->tags()->where('tag', $tag)->exists()) {
                $found_tag = Tag::where('tag', strtolower($tag))->first();
                if (is_null($found_tag)) {
                    $found_tag = Tag::create(['tag' => $tag]);
                    $found_tag->save();
                }
                // adds a record in the intersection table.
                $article->tags()->attach($found_tag);
            }
        }
    }

    private function remove_tags(array $tags, Article $article)
    {
        $db_tags = $article->tags()->get();
        foreach ($db_tags as $tag) {
            if (!in_array(trim($tag->tag), $tags)) {
                $article->tags()->detach($tag->id);
            }
        }
    }
}
