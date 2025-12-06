<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
        public function handle($request, Closure $next)
    {
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Silakan login.');
        }
        return $next($request);
    }

}
