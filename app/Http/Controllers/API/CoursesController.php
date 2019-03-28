<?php

namespace App\Http\Controllers\API;

use App\Course;
use App\Repositories\CoursesRepository as Courses;
use Exception;
use App\User;
use App\Http\Resources;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CoursesController extends Controller
{

    private $courses;
    // constructor injection
    public function __construct(Courses $course) {

        $this->courses = $course;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->courses->all(), 200);
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
            $validator = Validator::make($request->all(), Course::$validation_rules);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $course = $this->courses->create(
                [
                    'name' => $request['name'],
                    'description' => $request['description'],
                    'start' => $request['start'],
                    'end' => $request['end'],
                    'location' => $request['location'],
                    'user_id' => Auth::user()->id,
                ]);
            return response()->json($course, 201);
        }else{
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
        $course = $this->courses->find($id);
        return is_null($course) ? response()->json(null, 404) : response()->json($course, 200);
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
        $current_user = User::find(Auth::user()->id);
        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Course::$validation_rules);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $this->courses->update($request['id'], $request->all());
            return response()->json($course, 200);
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
            $course = $this->courses->find($id);
            if (is_null($course)) {
                return response()->json(null, 404);
            }
            $this->courses->delete($id);
            return response()->json(null, 204);
        }
        else {
            return response()->json(null, 403);
        }
    }

    public function participants(Request $request, Course $course){
        $participants = $course->participants()->get();

        return response()->json($participants, 200);
    }

    /**
     * @param Request $request
     * @param Courses $course
     * @return \Illuminate\Http\JsonResponse
     */
    public function participate(Request $request, Course $course){

        //TODO: find some more relevant status codes for the responses

        $current_user = User::find(Auth::user()->id);
        if($current_user->hasAnyRole(['Employee', 'Admin'])) {
            $participant = User::where('email', $request['email'])->first();
            if(!$participant){
                return response()->json(["message" => "Employee not found"], 404);
            }
            else if($course->participants()->where('id', '=', $participant->id)->exists()){
                return response()->json(["message" => "The employeee is already signed up for the course"], 400);
            }

            try {
                $course->participants()->attach($participant);
            } catch (Exception $exception) {
                return response()->json($exception->getMessage(), 400);
            }
            return response()->json(['message' => 'Success'], 200);
        }
        else{
            return response()->json(['message' => 'Forbidden'], 403);
        }
    }

    public function cancel(Request $request, Course $course){


        $current_user = User::find(Auth::user()->id);

        if($current_user->hasAnyRole(['Employee', 'Admin'])){
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
        }
        else{
            return response()->json(['message' => 'Forbidden'], 403);
        }


    }
}
