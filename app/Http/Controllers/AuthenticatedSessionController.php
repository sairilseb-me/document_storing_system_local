<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as FortifyAuthenticatedSessionController;

class AuthenticatedSessionController extends FortifyAuthenticatedSessionController
{
    protected function authenticated(Request $request, $user)
    {
        return response()->json(['message' => 'Authenticated', 'user' => $user]);
    }
}
