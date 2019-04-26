<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Meeting;
use App\Repositories\MeetingsRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    }

    /**
     * Display the specified resource.
     *
     * @param Meeting $meeting
     * @return Response
     */
    public function show(Meeting $meeting)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Meeting $meeting
     * @return Response
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}
