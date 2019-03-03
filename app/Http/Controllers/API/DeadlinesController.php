<?php

namespace App\Http\Controllers\API;

use App\Deadline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// TODO: implement CRUD methods
class DeadlinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function show(Deadline $deadline)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deadline  $deadline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deadline $deadline)
    {
        //
    }
}
