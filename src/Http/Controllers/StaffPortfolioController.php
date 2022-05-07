<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Corporate\Models\StaffMember;
use Eutranet\Corporate\Models\StaffPortfolio;
use Eutranet\Corporate\Models\User;
use Session;

/**
 * The staff user controller allows one to get access to user resources through the
 * staff_user pivot table. This controller is meant to manage a staff's user portfolio.
 *
 */
class StaffPortfolioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:staff']);
    }

	/**
	 * Get a portfolio of users for a staff member
	 * @param Request $request
	 * @param StaffMember $staffMember
	 * @return Application|Factory|View
	 */
    public function index(Request $request, StaffMember $staffMember): View|Factory|Application
    {
	    if ($request->get('filter') == 'contact') {
		    return view('corporate::staff-portfolio.index', ['staffMember' => $staffMember, 'users' => $staffMember->users()->where('user_status_id', 1)->paginate(10)]);
	    } elseif ($request->get('filter') == 'lead') {
		    return view('corporate::staff-portfolio.index', ['staffMember' => $staffMember, 'users' => $staffMember->users()->where('user_status_id', 2)->paginate(10)]);
	    } elseif ($request->get('filter') == 'customer') {
		    return view('corporate::staff-portfolio.index', ['staffMember' => $staffMember, 'users' => $staffMember->users()->where('user_status_id', 3)->paginate(10)]);
	    } elseif ($request->get('filter') == 'resolved') {
		    return view('corporate::staff-portfolio.index', ['staffMember' => $staffMember, 'users' => $staffMember->users()->where('user_status_id', 4)->paginate(10)]);
	    } elseif ($request->get('filter') == 'abandoned') {
		    return view('corporate::staff-portfolio.index', ['staffMember' => $staffMember, 'users' => $staffMember->users()->where('user_status_id', 5)->paginate(10)]);
	    } else {
		    return view('corporate::staff-portfolio.index', ['staffMember' => $staffMember, 'users' => $staffMember->users()->paginate(10)]);
	    }
    }

    /**
     * Get a portfolio of users for a staff member
     * @param StaffMember|null $staffMember
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(?StaffMember $staffMember, User $user): View|Factory|Application
    {
        $users = $staffMember->users ?? null;
        // Flash::success(__('Here is the '. Auth::user()->name. '\'s portfolio'));
        return view('corporate::staff-portfolio.show', ['staffMember' => $staffMember, 'users' => $users]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user()->hasRole('super-staff')) {
            $rules = [
                // You may explicitly specify the database column name that should be used by the validation rule by placing it after the database table name:
                'user_id' => ['exists:users,id'],
                'staff_member_id' => ['exists:staff_members,id'],
            ];

            $validatedData = $request->validateWithBag('staff_portfolio', $rules);
            $assignedUser = StaffPortfolio::create(['user_id' => $request->user_id, 'staff_member_id' => $request->staff_member_id]);
            return redirect()->back();
        }
        abort('403');
    }
}
