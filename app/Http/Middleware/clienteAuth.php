<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class clienteAuth
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('clientes')->check() === false)
        {
            return redirect()->route('goHome');
        }
        else
        {
            return $next($request);
        }
    }
}
