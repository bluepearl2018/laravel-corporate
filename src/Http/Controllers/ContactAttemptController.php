<?php

namespace Eutranet\Corporate\Http\Controllers;

use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Eutranet\Corporate\Models\ContactAttempt;
use Eutranet\Corporate\Models\Feedback;
use function view;
use Illuminate\Http\RedirectResponse;
use Flash;
use Validator;
use JetBrains\PhpStorm\Pure;
use Eutranet\Corporate\Models\User;

abstract class ContactAttemptController extends Abstracts\BaseContactAttemptController
{
	private string $viewPath;
	private string $targetModule;

	#[Pure] public function __construct()
    {
	    parent::__construct();
	    $this->viewPath = 'corporate'; // Module view path "viewpath" like in viewpath::folder.blade-name
	    $this->targetModule = 'admin';
		// $this->middleware('has-selu');
		// $this->middleware('has-user-info');
        // $this->authorizeResource(App\Models\ContactAttempt::class);
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param User|\App\Models\User|null $user
	 * @return Application|Factory|View
	 */
    public function create(User|\App\Models\User|null $user): View|Factory|Application
    {
        return view($this->viewPath.'::contact-attempts.create', [
			'user' => $user
        ]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @param User|\App\Models\User $user
	 * @return Application|Factory|View
	 */
    public function store(Request $request, User|\App\Models\User $user): Application|Factory|View
    {
        $rules = [
			'success' => 'boolean',
	        'body' => 'max:1200',
	        'user_id' => 'required|exists:users,id',
	        'staff_member_id' => 'required|exists:staff_members,id',
        ];

	    $validator = Validator::make($request->except('_token'), [
		    $rules
	    ]);

	    if ($validator->fails()) {
		    return view($this->viewPath.'::contact-attempts.create');
	    } else {
		    $validated = $request->validate($rules);
		    $contactAttempt = ContactAttempt::create($validated);
		    $feedback = new Feedback([
			    'body' => $request->body,
			    'staff_member_id' => Auth::id(),
			    'user_id' => $request->user_id,
			    'feedbackable_type' => 'Eutranet\Corporate\Models\ContactAttempt',
			    'feedbackable_id' => $contactAttempt->id,
			    'modified_by' => null
		    ]);
		    $feedback->save();
		    return redirect(route($this->targetModule.'.users.contact-attempts.show', [$user, $contactAttempt]));
	    }

    }

	/**
	 * Display the specified resource.
	 *
	 * @param User|\App\Models\User|null $user
	 * @param ContactAttempt $contactAttempt
	 * @return Application|Factory|View
	 */
    public function show(User|\App\Models\User|null $user, ContactAttempt $contactAttempt): View|Factory|Application
    {
        return view($this->viewPath.'::contact-attempts.show', ['user' => $user,'contactAttempt' => $contactAttempt]);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param User|\App\Models\User|null $user
	 * @param ContactAttempt $contactAttempt
	 * @return RedirectResponse
	 */
    public function edit(User|\App\Models\User|null $user, ContactAttempt $contactAttempt) : RedirectResponse
    {
		Flash::info(trans('Contact attempt edit is not available.'));
		return redirect()->back();
		// return view('corporate::contact-attempts.edit', ['contactAttempt' => $contactAttempt]);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request|\App\Models\User|null $request
	 * @param ContactAttempt|\App\Models\User|User $contactAttempt
	 * @return RedirectResponse
	 */
    public function update(Request|\App\Models\User|null $request, ContactAttempt|\App\Models\User|User $contactAttempt)
    {
	    Flash::info(trans('Contact attempt update is not available.'));
	    return redirect()->back();
    }

}
