<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        $current_user = User::find(Auth::user()->id);
        $token = $current_user->api_token;
        return response()->json(['token' => $token]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $token = Str::random(60);
        $request->user()->forceFill([
            'api_token' => $token,
        ])->save();

        return response()->json(['token' => $token], 200);
    }


}
