<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Eutranet\Corporate\Models\StaffMember;
use Eutranet\Corporate\Models\Consultation;

/**
 * The consultation staff controller allows the logged in staff member to retrieve a list
 * of consultations. The filtering is applied from the assigned consultant_id, which is a staff_member_id
 *
 */
class ConsultationStaffMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * Filtered if filter param from request
     * @param Request $request
     * @param StaffMember|null $staffMember
     * @param null $filter
     * @return Application|Factory|View
     */
    public function index(Request $request, ?StaffMember $staffMember, $filter = null): View|Factory|Application
    {

        // NOTE THE CONSULTATIONS HERE A FILTERED FOR THE STAFF MEMBER...
        $consultations = Consultation::where('staff_member_id', $staffMember->id)->orderBy('booked_on', 'desc')->orderBy('booked_at')->paginate(10) ?? null;

        if ($request->get('filter') == Carbon::today()->format('Y-m-d')) {
            return view('corporate::agenda.consultations', [
                'consultations' => $consultations->where('booked_on', Carbon::today()->format('Y-m-d'))
            ]);
        } elseif ($request->get('filter') == Carbon::tomorrow()->format('Y-m-d')) {
            return view('corporate::agenda.consultations', [
                'consultations' => $consultations->where('booked_on', Carbon::tomorrow()->format('Y-m-d'))
            ]);
        } elseif ($request->get('filter') == Carbon::yesterday()->format('Y-m-d')) {
            return view('corporate::agenda.consultations', [
                'consultations' => $consultations->where('booked_on', Carbon::yesterday()->format('Y-m-d'))
            ]);
        }
        return view('corporate::agenda.consultations', ['consultations' => $consultations, 'staffMember' => $staffMember]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $rules = [
          // You may explicitly specify the database column name that should be used by the validation rule by placing it after the database table name:
          'user_id' => ['exists:users,id'],
          'consultant_id' => ['exists:staff_members,id'],
          'staff_member_id' => ['exists:staff_members,id'],
        ];

        $validatedData = $request->validate($rules);
        $assignedUser = Consultation::create([
            'user_id' => $request->user_id,
            'staff_member_id' => $request->staff_member_id,
            'consultant_id' => $request->consultant_id
        ]);

        return redirect()->back();
    }
}
