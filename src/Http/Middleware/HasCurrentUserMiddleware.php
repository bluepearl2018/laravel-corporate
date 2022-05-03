<?php

namespace Florbela\FlorbelaBackend\Http\Middleware;

use Closure;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Session;

class HasCurrentUserMiddleware
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
        if (Session::get('users.currentUser')) {
            return $next($request);
        }
        Flash::warning(__('No user selected'));
        return redirect()->route('admin.dashboard');
    }
}
