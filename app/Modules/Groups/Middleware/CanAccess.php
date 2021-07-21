<?php

namespace App\Modules\Groups\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanAccess
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param $module
     * @param $permission
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next, $module, $permission)
    {
        if (!auth()->user()->canAccess(ucfirst($module), $permission)) {
            return abort(403);
        }
        return $next($request);
    }
}
