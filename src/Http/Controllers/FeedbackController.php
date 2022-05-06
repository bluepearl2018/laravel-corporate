<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Session;
use Eutranet\Corporate\Models\User;
use Eutranet\Corporate\Models\Feedback;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('has-selu');
        $this->middleware('has-user-info');
        // $this->authorizeResource(App\Models\Feedback::class);
    }

    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function index(User $user): View|Factory|Application
    {
        if ($user->feedbacks) {
            $feedbacks = Feedback::orderBy('created_at', 'desc')->paginate(10) ?: null;
        }
        return view('corporate::feedbacks.index', [
			'feedbacks' => $feedbacks,
	        'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('florbela-backend::feedbacks.create');
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
        $rules = [
            'body' => 'required|string|max:512',
            'feedbackable_type' => 'required|string|max:120',
            'feedbackable_id' => 'required|integer',
            'user_id' => 'exists:users,id',
            'staff_member_id' => 'exists:staff_members,id'
        ];
        $validated = $request->validate($rules);
        Feedback::create($validated);
        return redirect()->route('admin.users.feedbacks.index', [$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param Feedback $feedback
     * @return Application|Factory|View
     */
    public function show(Feedback $feedback): View|Factory|Application
    {
        return view('florbela-backend::feedbacks.show', $feedback);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Feedback $feedback
     * @return Application|Factory|View
     */
    public function edit(Feedback $feedback): View|Factory|Application
    {
        return view('florbela-backend::feedbacks.edit', ['feedback' => $feedback]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Feedback $feedback
     * @return Application|Factory|View
     */
    public function update(Request $request, Feedback $feedback): View|Factory|Application
    {
        $rules = [];
        $request->validate($rules);
        $feedback->update($request->all());
        $feedback = Feedback::firstOrCreate($request->all());
        return $this->show($feedback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Feedback $feedback
     * @return Application|Factory|View
     */
    public function destroy(Feedback $feedback): View|Factory|Application
    {
        $feedback->delete();
        return $this->index(null);
    }
}
