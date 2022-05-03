<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Corporate\Repository\Eloquent\AgencyRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Corporate\Models\Agency;
use Eutranet\Corporate\Models\Corporate;
use function view;

/**
 * Front AgencyController is to display an agency list and agency details
 */
class AgencyController extends Controller
{
    private AgencyRepository|null $agencyRepo;

    public function __construct(?AgencyRepository $agencyRepository)
    {
        $this->agencyRepo = $agencyRepository;
        // $this->authorizeResource(Agency::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Corporate|null $corporate
     * @return Application|Factory|View
     */
    public function index(?Corporate $corporate): View|Factory|Application
    {
        return view('corporate::agencies.index', ['agencies' => $this->agencyRepo->all()]);
    }

    /**
     * Display the create form.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('corporate::agencies.create');
    }

    /**
     * Display the specified resource.
     *
     * @param Agency $agency
     * @return Application|Factory|View
     */
    public function show(Agency $agency): View|Factory|Application
    {
        return view('corporate::agencies.show', ['agency' => $agency]);
    }


    /**
     * Display the specified resource.
     *
     * @param Agency $agency
     * @return Application|Factory|View
     */
    public function edit(Agency $agency): View|Factory|Application
    {
        return view('corporate::agencies.edit', ['agency' => $agency]);
    }
}
