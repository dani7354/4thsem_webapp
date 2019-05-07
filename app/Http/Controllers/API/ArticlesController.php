<?php

namespace App\Http\Controllers\API;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection as ArticleCollectionResource;
use App\Repositories\ArticlesRepository as ArticlesRepo;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticlesController extends Controller
{

    public function __construct(ArticlesRepo $articles)
    {
        $this->articles_repo = $articles;
    }

    /**
     * @OA\Get(
     *     path="/articles",
     *     tags={"articles"},
     *     summary="Returns all articles",
     *     description="All articles as JSON collection",
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
        return response()->json(new ArticleCollectionResource($this->articles_repo->all()), 200);
    }

    /**
     * @OA\Get(
     *     path="/articles/tag/{tag}",
     *     summary="Finds articles by tag",
     *      tags={"articles"},
     *     @OA\Parameter(
     *         name="tag",
     *         in="path",
     *         description="Tag to filter by",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     * ),
     *    @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *
     *          )
     *     )
     * )
     * */
    public function get_by_tag(Request $request)
    {
        $tag = Tag::where('tag', $request['tag'])->first();
        if (!$tag) {
            return response()->json("tag not found: " . $request['tag'], 404);
        }
        $articles = $tag->articles()->get();

        return response()->json(new ArticleCollectionResource($articles), 200);
    }


    /**
     * @OA\Post(
     *     path="/articles",
     *     tags={"articles"},
     *     summary="New article",
     *     description="",
     *     @OA\RequestBody(
     *         description="JSON object",
     *         required=true,
     *     @OA\JsonContent(
     *type="object",
     *      @OA\Property(property="title", type="string"),
     *      @OA\Property(property="content", type="string"),
     *      @OA\Property(property="tags", type="string")
     *)
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="created",
     *     )
     * )
     */
    public function store(Request $request)
    {
        // $current_user = User::find(Auth::user()->id);
        //if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Article::$validation_rules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

        $article = new Article();
        $article->title = $request['title'];
        $article->content = $request['content'];
        $article->date_created = now();
        $article->user_id = 1;
        $article->save();

            if (!empty($request['tags'])) {

                $this->save_tags($this->split_tags_to_array($request['tags']), $article);
            }

            return response()->json(null, 201);
        //   }
        //  else{
        //      return response()->json(null, 403);
        //  }
    }

    /**
     * @OA\Get(
     *     path="/articles/{id}",
     *     summary="Finds article by id",
     *      tags={"articles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     * ),
     *    @OA\Response(
     *         response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *
     *          )
     *     )
     * )
     * */
    public function show(Article $article)
    {
        return response()->json(new ArticleResource($article), 200);
    }

    /**
     * @OA\Put(
     *     path="/articles/{id}",
     *     tags={"articles"},
     *     summary="Updates article",
     *     description="",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     * ),
     *     @OA\RequestBody(
     *         description="JSON object",
     *         required=true,
     *     @OA\JsonContent(
     *type="object",
     *      @OA\Property(property="title", type="string"),
     *      @OA\Property(property="content", type="string"),
     *      @OA\Property(property="tags", type="string")
     *)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="updated",
     *     )
     * )
     */


    public function update(Request $request, Article $article)
    {
        //   $current_user = User::find(Auth::user()->id);
        // if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Article::$validation_rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $article->title = $request['title'];
            $article->content = $request['content'];
            $this->update_tags($request['tags'], $article);
            $article->save();


            return response()->json($article, 200);
        //  }
        // else{
        //  return response()->json(null, 403);
        //}

    }

    /**
     * @OA\Delete(
     *     path="/articles/{id}",
     *     summary="Deletes article by id",
     *      tags={"articles"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     * ),
     *    @OA\Response(
     *         response=204,
     *          description="successful operation",
     *          @OA\JsonContent(
     *
     *          )
     *     )
     * )
     * */




    public function destroy(Article $article)
    {
        //   $current_user = User::find(Auth::user()->id);
        //  if($current_user->hasRole('Admin')) {

            $article->delete();
            return response()->json(null, 204);
        //    }
        //    else{
        //      return response()->json(null, 403);
        //   }
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
