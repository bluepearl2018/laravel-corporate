<?php

namespace Eutranet\Corporate\Http\Middleware;

use Auth;
use Closure;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IsStaff
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
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            return $next($request);
        }
        Flash::error(__('You are not a staff member'));
        return redirect(route('admin.login'));
    }
}
