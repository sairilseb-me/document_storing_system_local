<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PingNas;


class CheckNasConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ping = new PingNas();
        $status = $ping->index();

        if ($status != 200)
        {

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json(['message' => 'NAS is not connected', 'key' => 'NAS'], 401);
        }

        return $next($request);
    }
}
