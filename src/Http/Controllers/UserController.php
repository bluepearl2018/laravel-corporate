<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Flash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Eutranet\Corporate\Traits\CorporateUsersTrait;
use Eutranet\Corporate\Models\User;
use function redirect;

/**
 *
 */
class UserController extends Controller
{
    use CorporateUsersTrait;

	/**
	 * @param Request $request
	 * @return Factory|View|Application
	 */
    public function index(Request $request): Factory|View|Application
    {
	    if ($request->get('filter') == 'contact') {
		    return view('corporate::users.index', ['users' => User::where('user_status_id', 1)->paginate(10)]);
	    } elseif ($request->get('filter') == 'lead') {
		    return view('corporate::users.index', ['users' => User::where('user_status_id', 2)->paginate(10)]);
	    } elseif ($request->get('filter') == 'customer') {
		    return view('corporate::users.index', ['users' => User::where('user_status_id', 3)->paginate(10)]);
	    } elseif ($request->get('filter') == 'resolved') {
		    return view('corporate::users.index', ['users' => User::where('user_status_id', 4)->paginate(10)]);
	    } elseif ($request->get('filter') == 'abandoned') {
		    return view('corporate::users.index', ['users' => User::where('user_status_id', 5)->paginate(10)]);
	    } else {
		    return view('corporate::users.index', ['users' => User::paginate(10)]);
	    }
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        Flash::warning('Make sure to use a e164 compliant phone number...');
        return view('theme::auth.register');
    }

    /**
     * @param User $user
     * @return Factory|View|Application
     */
    public function show(User $user): Factory|View|Application
    {
        return view('corporate::users.show', ['user' => $user]);
    }

    /**
     * @param User $user
     * @return Factory|View|Application
     */
    public function edit(User $user): Factory|View|Application
    {
        return view('corporate::users.edit', [
            'user' => $user
        ]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $rules = [
            'nif' => 'required|max:999999999',
            'country_id' => 'required|exists:countries,id',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
        ];
        $user->update($request->validate($rules));
        Flash::success('User account was updated');
        return redirect()->route('admin.users.show', $user);
    }

    /**
     * Desactivate the user account.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function toggleIsActive(Request $request, User $user): RedirectResponse
    {
        if ($user->is_active === 1) {
            $user->update(['is_active' => false]);
            Flash::success('User account is now inactive');
            return redirect()->route('admin.users.show', $user);
        }

        $user->update(['is_active' => true]);
        Flash::success('User account is now active');
        return redirect()->route('admin.users.show', $user);
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function destroy(User $user): View|Factory|Application
    {
        $user->delete();
        Flash::success(trans('User deleted'));
        return $this->index();
    }
}
