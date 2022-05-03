<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Eutranet\Corporate\Models\Corporate;
use function view;

/**
 * AgencyController allows administrators to manage agencies
 */
class CorporateController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:staff', 'role:super-staff']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('corporate::corporates.index', ['corporates' => Corporate::all()]);
    }

    /**
     * Display the resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('corporate::corporates.create');
    }

    /**
     * Display the resource.
     *
     * @param Corporate $corporate
     * @return Application|Factory|View
     */
    public function show(Corporate $corporate): View|Factory|Application
    {
        return view('corporate::corporates.show', ['corporate' => $corporate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Corporate $corporate
     * @return RedirectResponse
     */
    public function update(Request $request, Corporate $corporate): RedirectResponse
    {
        $validated = $this->getValidated($request);
        $corporate->update($validated);
        return redirect()->route('corporate::corporates.show', $corporate);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getValidated(Request $request): array
    {
        $rules = [
            'name' => 'string|max:100',
            'lead' => 'string|max:256',
            'description' => 'nullable|string|max:2048',
            'code' => 'nullable|max:100',
            'zone' => 'nullable|max:100',
            'address1' => 'nullable|string|max:38',
            'address2' => 'nullable|string|max:38',
            'postal_code' => 'nullable|string|max:16',
            'city' => 'nullable|string|max:38',
            'country_id' => 'nullable|exists:countries,id',
            'nif' => 'nullable|max:9',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:16',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'roles' => 'nullable|exists:roles,id',
            'staff_member_id' => 'nullable|exists:staff_members,id',
            'admin_id' => 'nullable|exists:admins,id',
            'is_active' => 'nullable|boolean'
        ];
        return $request->validate($rules);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Corporate $corporate
     * @return Application|Factory|View
     */
    public function edit(Corporate $corporate): View|Factory|Application
    {
        return view('corporate::corporates.edit', ['corporate' => $corporate]);
    }
}
