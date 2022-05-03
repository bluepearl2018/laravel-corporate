<?php

namespace Eutranet\Corporate\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Schema;
use Flash;

class EutranetCorporateInstalled
{
    public function handle($request, Closure $next)
    {
        if (!Schema::hasTable('countries')) {
            Flash::error('Please install Eutranet cororate.');
            return redirect()->route('install');
        }
        return $next($request);
    }
}
