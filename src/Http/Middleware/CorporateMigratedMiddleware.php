<?php

namespace Eutranet\Corporate\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Flash;
use DB;

class CorporateMigratedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next): mixed
    {
        if (\Schema::hasTable('install_statuses')) {
            if (DB::table('install_statuses')
                ->where('package_name', 'corporate')
                ->where('installed', true)->get()->first()) {
                return $next($request);
            }
            Flash::error('Corporate not intalled');
            return redirect(route('install.warning'));
        }
        return redirect(route('install.warning'));
    }
}
