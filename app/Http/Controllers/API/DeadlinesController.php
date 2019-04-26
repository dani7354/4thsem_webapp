<?php

namespace App\Http\Controllers\API;

use App\Deadline;
use App\Http\Controllers\Controller;
use App\Repositories\DeadlinesRepository as DeadlinesRepo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class DeadlinesController extends Controller
{


    public function __construct(DeadlinesRepo $deadlines)
    {
        $this->deadlines_repo = $deadlines;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json($this->deadlines_repo->all(), 200);
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
            $validator = Validator::make($request->all(), Deadline::$validation_rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $deadline = $this->deadlines_repo->create($request->all());
            return response()->json($deadline, 201);
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
        $deadline = $this->deadlines_repo->find($id);
        return is_null($deadline) ? response()->json(null, 404) : response()->json($deadline, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Deadline $deadline
     * @return Response
     */
    public function update(Request $request, Deadline $deadline)
    {
        $current_user = User::find(Auth::user()->id);
        if($current_user->hasRole('Admin')) {
            $validator = Validator::make($request->all(), Deadline::$validation_rules);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $this->deadlines_repo->update($request['id'], $request->all());
            return response()->json($deadline, 200);
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
            $deadline = Deadline::find($id);
            if (is_null($deadline)) {
                return response()->json(null, 404);
            }
            $this->deadlines_repo->delete($id);
            return response()->json(null, 204);
        }
        else{
            return response()->json(null, 403);
        }
    }
}
