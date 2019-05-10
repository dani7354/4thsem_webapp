<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function show()
    {
        $current_user = User::find(Auth::user()->id);
        $token = $current_user->api_token;
        return response()->json(['token' => $token]);
    }

    public function login(Request $request)
    {
        $login_successful = Auth::attempt(
            [
                "email" => $request["email"],
                "password" => $request["password"],
            ]
        );
        if ($login_successful) {
            $user = User::where('email', $request['email'])->first();

            $token = Str::random(60);
            $user->api_token = $token;
            $user->save();


            return response()->json(
                [
                "token" => $token,
                "name" => $user->name,
                "email" => $user->email,
            ], 200);

        }
        return response()->json("Unauthorized", 401);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
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
