<?php 
namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;

class LogoutResponse implements LogoutResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response 
     */
    public function toResponse($request)
    {
       $request->user()->tokens()->delete();

       return response()->json(['message' => 'Logged out', 'token' => Auth::user()->tokens->first()], 200);
    }
}


?>