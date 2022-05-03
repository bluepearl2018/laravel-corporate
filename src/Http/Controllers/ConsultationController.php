<?php

namespace Eutranet\Corporate\Http\Controllers;

use Eutranet\Corporate\Helpers\BookedOnHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Eutranet\Corporate\Models\User;
use Eutranet\Corproate\Models\Consultation;

class ConsultationController extends Controller
{
    private $bookedOn;

    public function __construct(BookedOnHelper $bookedOn)
    {
        $this->bookedOn = $bookedOn;
        $this->middleware('has-selu');
        $this->middleware('has-user-info');
    }

    /**
     * Display a listing of the resource.
     * Filtered if filter param from request
     * @param Request $request
     * @param User|null $user
     * @param null $filter
     * @return Application|Factory|View
     */
    public function index(Request $request, ?User $user, $filter = null): Factory|View|Application
    {
        $consultations = Consultation::orderBy('booked_on', 'desc')->orderBy('booked_at')->paginate(10) ?? null;
        if ($request->get('filter') == Carbon::today()->format('Y-m-d')) {
            return view('back.consultations.index', [
                'consultations' => $consultations->where('booked_on', Carbon::today()->format('Y-m-d'))
            ]);
        } elseif ($request->get('filter') == Carbon::tomorrow()->format('Y-m-d')) {
            return view('back.consultations.index', [
                'consultations' => $consultations->where('booked_on', Carbon::tomorrow()->format('Y-m-d'))
            ]);
        } elseif ($request->get('filter') == Carbon::yesterday()->format('Y-m-d')) {
            return view('back.consultations.index', [
                'consultations' => $consultations->where('booked_on', Carbon::yesterday()->format('Y-m-d'))
            ]);
        }
        return view('back.consultations.index', ['consultations' => $consultations, 'user' => $user]);
    }

    /**
     * Display a listing of the resource.
     * @param User $user
     * @return View|Factory|Application|RedirectResponse
     */
    public function userConsultations(User $user): View|Factory|Application|RedirectResponse
    {
        if ($user->consultations) {
            $consultations = Consultation::orderBy('booked_on', 'desc')->orderBy('booked_at')->where('user_id', $user->id)->get() ?? null;
            return view('back.consultations.index', ['consultations' => $consultations]);
        }
        return $this->create($user);
    }

    /**
     * Display a listing of the resource.
     * @param User|null $user
     * @return Application|Factory|View
     */
    public function create(?User $user): View|Factory|Application
    {
        return view('back.consultations.create', ['user' => $user]);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param User|null $user
     * @return RedirectResponse
     */
    public function store(Request $request, ?User $user): RedirectResponse
    {
        $rules = [
            'user_id' => 'exists:users,id',
            'staff_member_id' => 'exists:staff_members,id',
        ];
        $validated = $request->validate($rules);
        $consultation = Consultation::firstOrCreate($validated);

        $user->notify(new ConsultationBooked($consultation));
        return redirect()->route('admin.users.consultations.show', [$user, $consultation]);
    }

    /**
     * Display a listing of the resource.
     * Filtered if filter param from request
     * @param User|null $user
     * @param Consultation $consultation
     * @return Application|Factory|View
     */
    public function show(?User $user, Consultation $consultation): Factory|View|Application
    {
        return view('back.consultations.show', ['consultation' => $consultation]);
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @param User|null $user
     * @param Consultation $consultation
     * @return RedirectResponse
     */
    public function update(Request $request, ?User $user, Consultation $consultation): RedirectResponse
    {
        $rules = [
            'user_id' => 'exists:users,id',
            'agency_id' => 'exists:agencies,id',
            'consultant_id' => 'exists:staff_members,id',
            'booked_on' => 'date',
            'booked_at' => 'date_format:"H:i"',
            'staff_member_id' => 'exists:staff_members,id',
            'briefing' => 'nullable|max:1024'
        ];
        $validated = $request->validate($rules);
        $consultation->update($validated);
        return redirect()->route('admin.users.consultations.index', [$user]);
    }
}
