<?php

namespace Eutranet\Corporate\Traits;

use Eutranet\Corporate\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Flash;
use Eutranet\Commons\Models\UserStatus;

/**
 *
 */
trait CorporateUsersTrait
{

	/**
	 * @param Request $request
	 * @return Application|Factory|View
	 */
	public function findByNif(Request $request): Application|Factory|View
	{
		$users = User::paginate(10);
		$rules = [
			'nif' => 'nullable|min:1|max:999999999'
		];
		$validated = $request->validate($rules);
		if($validated){
			$nif = $request['nif'];
			$user = User::where('nif', '=', $nif)->get()->first();
			if($user !== NULL){
				Flash::success(__('A user with tax id was found'));
				return view('corporate::users.show', ['user' => $user]);
			} else {
				Flash::success(__('No user with this tax id'));
				return view('corporate::users.index', ['users' => $users]);
			}
		}
		Flash::error(__('Please enter a valid NIF'));
		return view('corporate::users.index', ['users' => $users]);
	}

	/**
	 * @param Request $request
	 * @return Application|Factory|View
	 */
	public function findByPhoneNumber(Request $request): Application|Factory|View
	{
		$users = User::paginate(10);
		$rules = [
			'phone' => 'nullable|min:3|max:16'
		];
		$validated = $request->validate($rules);
		if($validated){
			$phoneNumber = $request['phone'];
			$user = User::where('phone', $phoneNumber)->get()->first();
			// Todo get a filter strategy with phone number pattern
			if($user){
				Flash::success(__('A user with this phone number was found'));
				return view('corporate::users.show', ['user' => $user]);
			}
			Flash::success(__('No user with this phone number'));
			return view('corporate::users.index', ['user' => $users]);
		}
		Flash::error(__('Please enter a valid phone number'));
		return view('corporate::users.index', ['users' => $users]);
	}

	/**
	 * @param UserStatus $userStatus
	 * @return View
	 */
	public function filterByStatusCode(UserStatus $userStatus): View
	{
		$users = User::where('user_status_id', $userStatus->id)->paginate(10);
		return view('corporate::users.index', [
			'userStatus' =>  $userStatus,
			'filter' => $userStatus,
			'users' => $users
		]);
	}

}