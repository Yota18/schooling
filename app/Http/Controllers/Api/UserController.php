<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function refreshUser(Request $request)
    {
        $user = $request->user();
        $tokenResult = $request->bearerToken();

        return (new UserResource($user))->additional(
            [
                'meta' =>[
                    'code' => '200',
                    "message" => "OTP Submited"
                ],
                'data'=>[
                    'access_token' => $tokenResult,
                    'token_type' => "Bearer",
                    'email_verified_status' => true,
                ]
            ]
        );
    }

    public function Coba(Request $request)
    {
        return $request->header('key');
    }

}
