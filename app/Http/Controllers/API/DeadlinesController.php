<?php

namespace App\Http\Controllers\API;

use App\Deadline;
use App\Http\Controllers\Controller;
use App\Repositories\DeadlinesRepository as DeadlinesRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DeadlinesController extends Controller
{


    public function __construct(DeadlinesRepo $deadlines)
    {
        $this->deadlines_repo = $deadlines;

    }

    /**
     * @OA\Get(
     *     path="/deadlines",
     *     tags={"deadlines"},
     *     summary="Returns all deadlines",
     *     description="All deadlines as JSON collection",
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
        return response()->json($this->deadlines_repo->all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/deadlines",
     *     tags={"deadlines"},
     *     summary="new deadline",
     *     description="",
     *     @OA\RequestBody(
     *         description="JSON object",
     *         required=true,
     *     @OA\JsonContent(
     *type="object",
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="description", type="string"),
     *      @OA\Property(property="date", type="datetime")
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
//        $current_user = User::find(Auth::user()->id);
//        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Deadline::$validation_rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $deadline = $this->deadlines_repo->create($request->all());
            return response()->json($deadline, 201);
//        }
//        else{
//            return response()->json(null, 403);
//        }
    }

    /**
     * @OA\Get(
     *     path="/deadlines/{id}",
     *     summary="Finds deadlines by id",
     *      tags={"deadlines"},
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
    public function show($id)
    {
        $deadline = $this->deadlines_repo->find($id);
        return is_null($deadline) ? response()->json(null, 404) : response()->json($deadline, 200);
    }

    /**
     * @OA\Put(
     *     path="/deadlines/{id}",
     *     tags={"deadlines"},
     *     summary="update deadline",
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
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="description", type="string"),
     *      @OA\Property(property="date", type="datetime")
     *)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="updated",
     *     )
     * )
     */
    public function update(Request $request, Deadline $deadline)
    {
//        $current_user = User::find(Auth::user()->id);
//        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Deadline::$validation_rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $this->deadlines_repo->update($request['id'], $request->all());
        return response()->json(null, 200);
//        }
//        else{
//            return response()->json(null, 403);
//        }
    }

    /**
     * @OA\Delete(
     *     path="/deadlines/{id}",
     *     summary="Deletes deadline by id",
     *      tags={"deadlines"},
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





    public function destroy($id)
    {
//        $current_user = User::find(Auth::user()->id);
//        if($current_user->hasRole('Admin')) {
            $deadline = Deadline::find($id);
            if (is_null($deadline)) {
                return response()->json(null, 404);
            }
            $this->deadlines_repo->delete($id);
            return response()->json(null, 204);
//        }
//        else{
//            return response()->json(null, 403);
//        }
    }
}
