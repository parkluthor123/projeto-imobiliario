<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBackHistory
{
    public function handle($request, Closure $next) {
        $response = $next($request);

        return $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            ->header('Pragma','no-cache')
            ->header("Cache-Control: post-check=0, pre-check=0", false)
            ->header('Expires','Sat, 26 Jul 1997 05:00:00 GMT');
    }
}
