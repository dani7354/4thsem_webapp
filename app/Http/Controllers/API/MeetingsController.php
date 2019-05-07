<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MeetingsController extends Controller
{


    /**
     * @OA\Get(
     *     path="/meetings",
     *     tags={"meetings"},
     *     summary="Returns all meetings",
     *     description="All meetings as JSON collection",
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
        return response()->json(Meeting::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/meetings",
     *     tags={"meetings"},
     *     summary="New meeting",
     *     description="",
     *     @OA\RequestBody(
     *         description="JSON object",
     *         required=true,
     *     @OA\JsonContent(
     *type="object",
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="host", type="string"),
     *      @OA\Property(property="description", type="string"),
     *      @OA\Property(property="location", type="string"),
     *      @OA\Property(property="start", type="string"),
     *      @OA\Property(property="end", type="string")
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
        $validator = Validator::make($request->all(), Meeting::$validation_rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $meeting = Meeting::create($request->all());
        return response()->json($meeting, 201);
    }

    /**
     * @OA\Get(
     *     path="/meetings/{id}",
     *     summary="Finds meeting by id",
     *      tags={"meetings"},
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


    public function show(Meeting $meeting)
    {
       return response()->json($meeting, 200);
    }

    /**
     * @OA\Get(
     *     path="/meetings/date/{date}",
     *     summary="Finds meetings by date",
     *      tags={"meetings"},
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
        $result = Meeting::whereDate('start', '=', date('Y-m-d', $date))->get();
        return $result->first() ? response()->json($result, 200) : response()->json(['message' => 'no meetings found'], 404);
    }


    /**
     * @OA\Put(
     *     path="/meetings/{id}",
     *     tags={"meetings"},
     *     summary="Updates meeting",
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
     *     @OA\Property(property="name", type="string"),
     *      @OA\Property(property="host", type="string"),
     *      @OA\Property(property="description", type="string"),
     *      @OA\Property(property="location", type="string"),
     *      @OA\Property(property="start", type="string"),
     *      @OA\Property(property="end", type="string")
     *)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="updated",
     *     )
     * )
     */


    public function update(Request $request, Meeting $meeting)
    {
        $validator = Validator::make($request->all(), Meeting::$validation_rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $meeting->update($request->all());
        $meeting->fresh();
        return response()->json($meeting, 200);
    }

    /**
     * @OA\Delete(
     *     path="/meetings/{id}",
     *     summary="Deletes meeting by id",
     *      tags={"meetings"},
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


    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return response()->json("", 204);
    }
}
