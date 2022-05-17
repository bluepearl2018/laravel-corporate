<?php

namespace Eutranet\Corporate\Http\Controllers\Abstracts;

use App\Http\Controllers\Controller;
use Eutranet\Corporate\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Eutranet\Corporate\Models\ContactAttempt;
use function view;
use Illuminate\Http\RedirectResponse;

abstract class BaseContactAttemptController extends Controller
{
	private string $viewPath;
	private string $viewFolder;
	private string $targetModule;

	public function __construct($viewPath = null, $targetModule = null, $viewFolder = null)
	{
		$this->viewPath = $viewPath ?? 'corporate';
		$this->viewFolder = $viewFolder ?? 'contact-attempts';
		$this->targetModule = $targetModule ?? 'admin';
		// $this->middleware('has-selu');
		// $this->middleware('has-user-info');
		// $this->authorizeResource(App\Models\ContactAttempt::class);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param User|null $user
	 * @return Application|Factory|View
	 */
	public function index(?User $user): View|Factory|Application
	{
		$contactAttempts = $user->contactAttempts ?? ContactAttempt::all();
		return view($this->viewPath.'::'.$this->viewFolder.'.index', [
			'contactAttempts' => $contactAttempts,
			'user' => $user
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param User|null $user
	 * @return Application|Factory|View
	 */
	public function create(?User $user): View|Factory|Application
	{
		return view($this->viewPath.'::'.$this->viewFolder.'.create', [
			'user' => $user
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param User $user
	 * @return Application|Factory|View|RedirectResponse
	 */
	abstract public function store(Request $request, User $user): Application|Factory|View|RedirectResponse;

	/**
	 * Display the specified resource.
	 *
	 * @param User $user
	 * @param ContactAttempt $contactAttempt
	 * @return Application|Factory|View
	 */
	public function show(User $user, ContactAttempt $contactAttempt): View|Factory|Application
	{
		return view($this->viewPath.'::'.$this->viewFolder.'.show',
			['user' => $user,'contactAttempt' => $contactAttempt]
		);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param User|null $user
	 * @param ContactAttempt $contactAttempt
	 * @return RedirectResponse|View|Factory|Application
	 */
	abstract public function edit(?User $user, ContactAttempt $contactAttempt): RedirectResponse|View|Factory|Application;

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param User $user
	 * @param ContactAttempt $contactAttempt
	 * @return Application|Factory|View
	 */
	abstract public function update(Request $request, User $user, ContactAttempt $contactAttempt): Application|Factory|View;

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param User|null $user
	 * @param ContactAttempt $contactAttempt
	 * @return RedirectResponse
	 */
	abstract public function destroy(?User $user, ContactAttempt $contactAttempt): RedirectResponse;
}
