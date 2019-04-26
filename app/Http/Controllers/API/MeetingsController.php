<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Meeting;
use App\Repositories\MeetingsRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MeetingsController extends Controller
{

    public function __construct(MeetingsRepository $meetings)
    {
        $this->meetings = $meetings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json($this->meetings->all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Meeting::$validation_rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $this->meetings->create($request->all());
        return response()->json("", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Meeting $id
     * @return Response
     */
    public function show($id)
    {
        $result = $this->meetings->find($id);
        return is_null($result) ? response()->json("not found", 404) : response()->json($result, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Meeting $meeting
     * @return Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        $validator = Validator::make($request->all(), Meeting::$validation_rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $meeting->update($request->all());
        return response()->json($meeting, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Meeting $meeting
     * @return Response
     * @throws Exception
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return response()->json("", 204);
    }
}
