<?php

namespace App\Http\Controllers\API;

use App\Course;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CoursesController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Course::get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Course::$validation_rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
       $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        return is_null($course) ? response()->json(null, 404) : response($course, 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), Course::$validation_rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $course->update($request->all());
        return response()->json($course, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);
        if(is_null($course)){
            return response()->json(null, 404);
        }
        $course->delete();
        return response()->json(null, 204);
    }

    public function participants(Request $request, Course $course){
        $participants = $course->participants();

        return response()->json($participants, 200);
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function participate(Request $request, Course $course){
        // TODO: should be the authenticated user

        $course->participants()->attach($request['user_id']);
        return response()->json(null, 204);
    }
}
