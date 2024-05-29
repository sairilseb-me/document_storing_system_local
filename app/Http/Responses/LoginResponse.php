<?php

namespace App\Http\Responses;
use Laravel\Fortify\Http\Responses\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        $token = $request->user()->createToken('store_token')->plainTextToken;
        return response()->json(['token' => $token, 'user' => Auth::user()]);
    }
}




?>