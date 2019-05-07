<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Resources\Course as CourseResource;
use App\Http\Resources\CourseWithParticipants as CourseWithParticipantsResource;
use App\Repositories\CoursesRepository as CoursesRepo;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CoursesController extends Controller
{

    /**
     * @OA\Get(
     *     path="/courses",
     *     tags={"courses"},
     *     summary="Returns all courses",
     *     description="All courses as JSON collection",
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
        return response()->json(Course::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/courses",
     *     tags={"courses"},
     *     summary="New course",
     *     description="",
     *     @OA\RequestBody(
     *         description="JSON object",
     *         required=true,
     *     @OA\JsonContent(
     *type="object",
     *      @OA\Property(property="name", type="string"),
     *      @OA\Property(property="description", type="string"),
     *      @OA\Property(property="start", type="string"),
     *      @OA\Property(property="end", type="string"),
     *      @OA\Property(property="location", type="string"),
     *      @OA\Property(property="host", type="string"),
     *      @OA\Property(property="target_audience", type="string")
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
            $validator = Validator::make($request->all(), Course::$validation_rules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $course = Course::create($request->all());

            return response()->json($course, 201);
//        }else{
//            return response()->json(null, 403);
//        }
    }

    /**
     * @OA\Get(
     *     path="/courses/{id}",
     *     summary="Finds courses by id",
     *      tags={"courses"},
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
    public function show(Course $course)
    {
        return response()->json(new CourseResource($course), 200);
    }

    /**
     * @OA\Put(
     *     path="/courses/{id}",
     *     tags={"courses"},
     *     summary="updates course",
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
     *      @OA\Property(property="start", type="string"),
     *      @OA\Property(property="end", type="string"),
     *      @OA\Property(property="location", type="string"),
     *      @OA\Property(property="host", type="string"),
     *      @OA\Property(property="target_audience", type="string")
     *)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="updated",
     *     )
     * )
     */
    public function update(Request $request, Course $course)
    {
//        $current_user = User::find(Auth::user()->id);
//        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Course::$validation_rules);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $course->update($request->all());
            $course->fresh();
        return response()->json($course, 200);
//        }
//        else{
//            return response()->json(null, 403);
//        }


    }

    /**
     * @OA\Delete(
     *     path="/courses/{id}",
     *     summary="Deletes course by id",
     *      tags={"courses"},
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
    public function destroy(Course $course)
    {
//        $current_user = User::find(Auth::user()->id);
//        if($current_user->hasRole('Admin')) {

            $course->delete();
            return response()->json(null, 204);
//        }
//        else {
//            return response()->json(null, 403);
//        }
    }

    /**
     * @OA\Get(
     *     path="/courses/{id}/participants",
     *     summary="Finds participants for course by id",
     *      tags={"courses"},
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

    public function participants(Course $course){
        $course = Course::with('participants')->find($course->id);
        return response()->json(new CourseWithParticipantsResource($course), 200);
    }

    /**
     * @OA\Post(
     *     path="/courses/{id}/participants",
     *     tags={"courses"},
     *     summary="adds participant to course",
     *     description="",
     * @OA\Parameter(
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
     *      @OA\Property(property="email", type="string")
     *
     *)
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="created",
     *     )
     * )
     */
    public function participate(Request $request, Course $course){

//        $current_user = User::find(Auth::user()->id);
//        if($current_user->hasAnyRole(['Employee', 'Admin'])) {
            $participant = User::where('email', $request['email'])->first();
            if(!$participant){
                return response()->json(["message" => "Employee not found"], 404);
            }
            else if($course->participants()->where('id', '=', $participant->id)->exists()){
                return response()->json(["message" => "The employee is already signed up for the course"], 400);
            }

            try {
                $course->participants()->attach($participant);
            } catch (Exception $exception) {
                return response()->json($exception->getMessage(), 400);
            }
            return response()->json(['message' => 'Success'], 201);
//        }
//        else{
//            return response()->json(['message' => 'Forbidden'], 403);
//        }
    }

    /**
     * @OA\Delete(
     *     path="/courses/{id}/participants",
     *     tags={"courses"},
     *     summary="removes participant from course",
     *     description="",
     * @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     * ),
     *   @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="created",
     *     )
     * )
     */

    public function cancel(Request $request, Course $course){


//        $current_user = User::find(Auth::user()->id);
//
//        if($current_user->hasAnyRole(['Employee', 'Admin'])){
            $participant = User::where('email', $request['email'])->first();

            if(!$participant){
                return response()->json(['message' => 'Employee not found'], 404);
            }
            else if(!$course->participants()->where('id', '=', $participant->id)->exists()){
                return response()->json(['message' => 'The employee is not signed up for the course'], 400);
            }
            try {
                $course->participants()->detach($participant->id);
            } catch (Exception $exception) {
                return response()->json($exception->getMessage(), 400);
            }
            return response()->json(['message' => 'Cancel completed'], 200);
//        }
//        else{
//            return response()->json(['message' => 'Forbidden'], 403);
//        }


    }
}
