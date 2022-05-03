<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Corporate\Models\Agency;
use function view;

/**
 * Front AgencyController is to display an agency list and agency details
 */
class BackOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
        // $this->authorizeResource(Agency::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('front.corporates.agencies.index', ['agencies' => $this->agencyRepo->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param Agency $agency
     * @return Application|Factory|View
     */
    public function show(Agency $agency): View|Factory|Application
    {
        return view('front.corporates.agencies.show', ['agency' => $agency]);
    }
}
