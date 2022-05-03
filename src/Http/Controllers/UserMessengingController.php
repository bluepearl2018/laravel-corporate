<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Corporate\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Eutranet\Setup\Models\Email;
use Eutranet\Corporate\Traits\BackendMailerTrait;
use Illuminate\Http\RedirectResponse;
use Eutranet\Corporate\Traits\BackendNotificationTrait;

/**
 * This controller is mainly intended to authenticated staff members.
 * It uses the Backend Mail Trait...
 */
class UserMessengingController extends Controller
{
    use BackendMailerTrait;
    use BackendNotificationTrait;

    /**
     *
     */
    public function __construct()
    {
        $this->middleware(['auth:staff']);
    }

    /**
     * @param User $user
     * @return Factory|View|Application
     */
    public function create(User $user): Factory|View|Application
    {
        return view('corporate::messages.create', ['user' => $user, 'templates' => $messengingTemplates ?? null]);
    }

    /**
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function store(Request $request, User $user): RedirectResponse
    {
        // Todo : check if this correctly sends this email
        $rules = [
            'from' => 'exists:staff_members,email',
            'to' => 'exists:users,email',
            'subject' => 'string|max:500',
            'message_body' => 'max:500',
            'user_id' => 'exists:users,id',
            'staff_member_id' => 'exists:staff_members,id'
        ];
        $validated = $request->validate($rules);
        $email = Email::create($validated);
        $this->sendHtmlMessage($request);
        return redirect()->route('admin.dashboard');
    }
}
