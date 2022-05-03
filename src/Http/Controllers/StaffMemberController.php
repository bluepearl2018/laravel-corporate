<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Eutranet\Setup\Models\StaffMember;
use Illuminate\Http\RedirectResponse;
use Auth;
use Eutranet\Corporate\Models\Corporate;
use function view;

class StaffMemberController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(App\Models\StaffMember::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Corporate|null $corporate
     * @return Application|Factory|View
     */
    public function index(?Corporate $corporate): View|Factory|Application
    {
        sizeof($corporate->staffMembers) > 0 ? $staffMembers = $corporate->staffMembers()->get()->paginate(12) : $staffMembers = StaffMember::paginate(12);
        return view('corporate::staff-members.index', ['staffMembers' => $staffMembers, 'corporate' => $corporate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        if (Auth::check() && Auth::user()->hasRole(['admin', 'super-staff'])) {
            return view('corporate::staff-members.create');
        }
        return abort('403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::check() && Auth::user()->hasRole(['admin', 'super-staff'])) {
            $rules = [];
            $validated = $request->validate($rules);
            $staffMember = StaffMember::firstOrCreate($validated);
            return redirect()->route('corporate::staff-members.show', $staffMember);
        }
        return abort('403');
    }

    /**
     * Display the specified resource.
     *
     * @param Corporate|null $corporate
     * @param StaffMember $staffMember
     * @return Application|Factory|View
     */
    public function show(?Corporate $corporate, StaffMember $staffMember): View|Factory|Application
    {
        return view('corporate::staff-members.show', ['staffMember' => $staffMember]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param StaffMember $staffMember
     * @return Application|Factory|View
     */
    public function edit(StaffMember $staffMember): View|Factory|Application
    {
        if (Auth::check() && Auth::user()->hasRole(['admin', 'super-staff'])) {
            return view('corporate::staff-members.edit', ['staffMember' => $staffMember]);
        }
        return abort('403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param StaffMember $staffMember
     * @return RedirectResponse
     */
    public function update(Request $request, StaffMember $staffMember): RedirectResponse
    {
        if (Auth::check() && Auth::user()->hasRole(['admin', 'super-staff'])) {
            $rules = [
                'login' => 'max:255',
                'email' => 'email|required|string|max:255|unique:staff_members,email,$this->id,id',
                'country_id' => 'exists:countries,id',
                'representante' => 'nullable|max:50',
                'agency_id' => 'exists:agencies,id',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
                'nif' => 'required|size:9'
            ];
            $validated = $request->validate($rules);
            $staffMember->update($validated);
            return redirect()->route('staff-members.show', $staffMember);
        }
        return abort('403');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param StaffMember $staffMember
     * @return void
     */
    public function destroy(StaffMember $staffMember)
    {
        $staffMember->delete();
    }
}
