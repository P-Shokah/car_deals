<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileCompleteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  
        $profile1 = $request->user()->vendor;
        $profile2 = $request->user()->client;
        if (!$profile1 || !$profile1->is_completed) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Your vendor profile is not completed',
                ], 403);
        }
        elseif(!$profile2 || !$profile2->is_completed){
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Your client profile is not completed',
                ], 403);
        }
        return $next($request);
    }
}
