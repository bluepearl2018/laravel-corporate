<?php

namespace Eutranet\Corporate\Http\Middleware;

use Auth;
use Closure;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsDataOfficer
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (Auth::check() && Auth::user()->hasRole('data-officer')) {
            Flash::warning('You are acting as a data officer.');
            return $next($request);
        }
        Flash::error(__('You are not the data officer'));
        return abort('403');
    }
}
