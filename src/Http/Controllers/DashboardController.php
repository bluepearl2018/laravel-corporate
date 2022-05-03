<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Setup\Models\ModelDoc;
use Eutranet\Corporate\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Flash;

/**
 *
 */
class DashboardController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $userCount = User::count();
        $users = User::latest()->take('5')->get();

        return view('corporate::dashboard', [
            'modelDocs' => ModelDoc::all(),
            'userCount' => $userCount,
            'users' => $users,
            'lastFiveUsers' => $users
        ]);
    }

    /**
     * Retrieve the authenticated back-end user account
     * @return Factory|View|Application
     */
    public function myAccount(): Factory|View|Application
    {
        Flash::success('Your account details');
        return view('corporate::dashboard.my-account', [
            'user' => Auth::user()
        ]);
    }
}
