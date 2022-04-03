<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class ApprovalMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            if (!auth()->user()->approved) {
                auth()->logout();
                return redirect()->route('login')->with('message', trans('global.yourAccountNeedsAdminApproval'));
            }
        }
        return $next($request);
    }
}
