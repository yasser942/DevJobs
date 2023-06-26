<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the authenticated user is an admin
         if (!auth()->user() || auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
        }
        return $next($request);
    }
}
