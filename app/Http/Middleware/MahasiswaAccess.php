<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->user_type === 'mahasiswa') {
            return $next($request);
        }
        abort(403); // Forbidden access
    }
}