<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Session;
use Eutranet\Corporate\Models\ContactAttempt;
use Eutranet\Corporate\Models\Feedback;
use function view;
use Illuminate\Http\RedirectResponse;
use Flash;
use Illuminate\Routing\Redirector;

class ContactAttemptController extends Controller
{
    public function __construct()
    {
        $this->middleware('has-selu');
        $this->middleware('has-user-info');
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
        if (isset(Session::get('users.selectedUser')->consultations) && Session::get('users.selectedUser')->contactAttempts->count() > 0) {
            $contactAttempts = Session::get('users.selectedUser')->contactAttempts->sortByDesc('created_at') ?? $contactAttempts = null;
        }
        $contactAttempts = $user->contactAttempts ?? $contactAttempts = ContactAttempt::all();
        return view('corporate::contact-attempts.index', [
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
        return view('corporate::contact-attempts.create', [
			'user' => $user
        ]);
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @param User $user
	 * @return RedirectResponse
	 */
    public function store(Request $request, User $user): RedirectResponse
    {
        $success = '';
        if ($request->has('success')) {
            $request->success == 'on' ? $success = true : $success = false;
        }
        $rules = [
          'body' => 'max:1200',
        ];
        $validated = $request->validate($rules);
        $contactAttempt = ContactAttempt::create([
            'success' => $success,
            'user_id' => $user->id,
            'staff_member_id' => Auth::id()
        ]);
        $feedback = new Feedback([
            'body' => $request->body,
            'staff_member_id' => Auth::id(),
            'user_id' => $request->user_id,
            'feedbackable_type' => 'Eutranet\Corporate\Models\ContactAttempt',
            'feedbackable_id' => $contactAttempt->id,
            'modified_by' => null
        ]);
        $feedback->save();
        return redirect(route('admin.users.contact-attempts.show', [$user, $contactAttempt]));
    }

    /**
     * Display the specified resource.
     *
     * @param User|null $user
     * @param ContactAttempt $contactAttempt
     * @return Application|Factory|View
     */
    public function show(?User $user, ContactAttempt $contactAttempt): View|Factory|Application
    {
        return view('corporate::contact-attempts.show', ['user' => $user,'contactAttempt' => $contactAttempt]);
    }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param User|null $user
	 * @param ContactAttempt $contactAttempt
	 * @return RedirectResponse
	 */
    public function edit(?User $user, ContactAttempt $contactAttempt) : RedirectResponse
    {
		Flash::info(trans('Contact attempt edit is not available.'));
		return back();
		// return view('corporate::contact-attempts.edit', ['contactAttempt' => $contactAttempt]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param ContactAttempt $contactAttempt
     * @return RedirectResponse
     */
    public function update(Request $request, ContactAttempt $contactAttempt): RedirectResponse
    {
	    Flash::info(trans('Contact attempt update is not available.'));
	    return back();
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param ContactAttempt $contactAttempt
	 * @return RedirectResponse
	 */
    public function destroy(ContactAttempt $contactAttempt): RedirectResponse
    {
	    Flash::info(trans('Contact attempt deletion is not available.'));
	    return back();
    }
}
