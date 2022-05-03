<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Setup\Models\StaffMember;
use Eutranet\Corporate\Models\StaffMemberUser;
use Eutranet\Corporate\Models\User;

/**
 * The staff user controller allows one to get access to user resources through the
 * staff_user pivot table. This controller is meant to manage a staff's user portfolio.
 *
 */
class StaffMemberUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:staff']);
    }

    /**
     * Get a portfolio of users for a staff member
     * @param StaffMember $staffMember
     * @return Application|Factory|View
     */
    public function index(StaffMember $staffMember): View|Factory|Application
    {
        $users = $staffMember->users ?? null;
        // Flash::success(__('Here is the '. Auth::user()->name. '\'s portfolio'));
        return view('corporate::users.index', ['staffMember' => $staffMember, 'users' => $users]);
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
        return view('corporate::users.show', ['user' => $user]);
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
                'user_id' => ['unique:staff_member_user', 'exists:users,id'],
                'staff_member_id' => ['exists:staff_members,id'],
            ];

            $validatedData = $request->validateWithBag('staff_member_user', $rules);
            $assignedUser = StaffMemberUser::create(['user_id' => $request->user_id, 'staff_member_id' => $request->staff_member_id]);
            return redirect()->back();
        }
        abort('403');
    }
}
