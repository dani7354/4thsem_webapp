<?php

namespace App\Http\Controllers\API;

use App\Deadline;
use App\Http\Controllers\Controller;
use App\Repositories\DeadlinesRepository as DeadlinesRepo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class DeadlinesController extends Controller
{

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
        return response()->json(Deadline::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/deadlines",
     *     tags={"deadlines"},
     *     summary="New deadline",
     *     description="",
     *     @OA\RequestBody(
     *         description="JSON object",
     *         required=true,
     *     @OA\JsonContent(
     *type="object",
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="description", type="string"),
     *      @OA\Property(property="date", type="string")
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
        $current_user = User::find(Auth::user()->id);
        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Deadline::$validation_rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $deadline = Deadline::create($request->all());
            return response()->json($deadline, 201);
        }
        else{
            return response()->json(null, 403);
        }
    }

    /**
     * @OA\Get(
     *     path="/deadlines/{id}",
     *     summary="Finds deadline by id",
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
    public function show(Deadline $deadline)
    {
        return response()->json($deadline, 200);
    }

    /**
     * @OA\Get(
     *     path="/deadlines/date/{date}",
     *     summary="Finds deadlines by date",
     *      tags={"deadlines"},
     *     @OA\Parameter(
     *         name="date",
     *         in="path",
     *         description="Date",
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

    public function get_by_date(Request $request)
    {
        $date = strtotime($request['date']);
        $result = Deadline::whereDate('date', '=', date('Y-m-d', $date))->get();
        return $result->first() ? response()->json($result, 200) : response()->json([ 'message' => 'no deadlines found'], 200);
    }

    /**
     * @OA\Put(
     *     path="/deadlines/{id}",
     *     tags={"deadlines"},
     *     summary="Updates deadline",
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
     *      @OA\Property(property="date", type="string")
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
       $current_user = User::find(Auth::user()->id);
        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Deadline::$validation_rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
           $deadline->update($request->all());
        return response()->json(null, 200);
        }
        else{
            return response()->json(null, 403);
        }
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

    public function destroy(Deadline $deadline)
    {
        $current_user = User::find(Auth::user()->id);
        if($current_user->hasRole('Admin')) {
        $deadline->delete();
            return response()->json(null, 204);
        }
        else{
            return response()->json(null, 403);
        }
    }
}
