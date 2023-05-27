<?php

namespace App\Http\Middleware;

use App\Models\Fun;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class AdminMid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check())
            return redirect()->route('b.login');
        if ($request->user() && !Role::_checkurl($request->user()->id, $request->route()->getName())) {
            return redirect()->route('b.403');
        } else {
            return $next($request);
        }
    }
}
