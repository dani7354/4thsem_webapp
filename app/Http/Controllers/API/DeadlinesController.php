<?php

namespace App\Http\Controllers\API;

use App\Deadline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Integer;


class DeadlinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deadlines = Deadline::get();
        return response()->json($deadlines, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Deadline::$validation_rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $deadline = Deadline::create($request->all());
        return response()->json($deadline, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deadline = Deadline::find($id);
        return is_null($deadline) ? response()->json(null, 404) : response()->json($deadline, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deadline $deadline)
    {
        $validator = Validator::make($request->all(), Deadline::$validation_rules);
        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $deadline->update($request->all());
        return response()->json($deadline, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deadline = Deadline::find($id);
        if(is_null($deadline)){
            return response()->json(null, 404);
        }
        $deadline->delete();
        return response()->json(null, 204);
    }
}
