<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Corporate\Models\CorporateAgreement;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;

/**
 *
 */
class CorporateAgreementController extends Controller
{
    /**
     * Corporate agreements are to be modified by the HR manager??
     */
    public function __construct()
    {
        $this->middleware(['auth:staff', 'role:super-staff']);
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $corporateAgreemeents = CorporateAgreement::all();
        return view('corporate::corporate-agreements.index', ['corporateAgreements' => $corporateAgreemeents]);
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('corporate::corporate-agreements.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (Auth::user('staff')->hasRole('super-staff')) {
            $rules = [
                'name' => 'string|max:255',
                'description' => 'string|max:140',
                'lead' => 'string|max:512',
                'general_terms' => 'string|max:2048',
            ];
            $validated = $request->validate($rules);
            $corporateAgreement = CorporateAgreement::create($validated);
            return redirect(route('admin.corporate-agreements.show', $corporateAgreement));
        }
        return abort('403', 'For HR Manager only');
    }

    /**
     * @param CorporateAgreement $corporateAgreement
     * @return Factory|View|Application
     */
    public function show(CorporateAgreement $corporateAgreement): Factory|View|Application
    {
        return view('corporate::corporate-agreements.show', ['corporateAgreement' => $corporateAgreement]);
    }

    /**
     * @param CorporateAgreement $corporateAgreement
     * @return Factory|View|Application
     */
    public function edit(CorporateAgreement $corporateAgreement): Factory|View|Application
    {
        if (Auth::user('staff')->hasRole('super-staff')) {
            return view('corporate::corporate-agreements.edit', ['corporateAgreement' => $corporateAgreement]);
        }
        return abort('403', 'For HR Manager only');
    }

    /**
     * @param Request $request
     * @param CorporateAgreement $corporateAgreement
     * @return RedirectResponse
     */
    public function update(Request $request, CorporateAgreement $corporateAgreement): RedirectResponse
    {
        if (Auth::user('staff')->hasRole('super-staff')) {
            $rules = [
                'name' => 'string|max:255',
                'description' => 'string|max:140',
                'lead' => 'string|max:512',
                'general_terms' => 'string|max:2048',
            ];
            $validated = $request->validate($rules);
            $corporateAgreement->update($validated);
            return redirect(route('admin.corporate-agreements.show', $corporateAgreement));
        }
        return abort('403', 'For HR Manager only');
    }

    /**
     * @param Request $request
     * @param CorporateAgreement $corporateAgreement
     * @return Redirector|Application|RedirectResponse
     */
    public function destroy(Request $request, CorporateAgreement $corporateAgreement): Redirector|Application|RedirectResponse
    {
        if (Auth::user('staff')->hasRole('super-staff')) {
            $corporateAgreement->delete();
            \Flash::success('Corporate agreement deleted');
            return redirect(route('admin.corpporate-agreements.index'));
        }
        return abort('403', 'For HR Manager only');
    }
}
