<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Setup\Models\GeneralTerm;
use Eutranet\Corporate\Repository\Eloquent\CorporateGeneralTermRepository;

/**
 * This controller allows admins to display the list of the laravel-corporate
 * general terms and to show general terms details
 */
class CorporateGeneralTermController extends Controller
{
    /**
     * @var CorporateGeneralTermRepository
     */
    private CorporateGeneralTermRepository $corporateGeneralTermRepo;

    /**
     * @param CorporateGeneralTermRepository $corporateGeneralTermRepository
     */
    public function __construct(CorporateGeneralTermRepository $corporateGeneralTermRepository)
    {
        $this->corporateGeneralTermRepo = $corporateGeneralTermRepository;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('corporate::corporate-general-terms.index', [
            'generalTerms' => $this->corporateGeneralTermRepo->all()
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('corporate::corporate-general-terms.create');
    }

    /**
     * @param GeneralTerm $generalTerm
     * @return Application|Factory|View
     */
    public function show(GeneralTerm $generalTerm): View|Factory|Application
    {
        return view('corporate::corporate-general-terms.show', [
            'generalTerm' => $generalTerm
        ]);
    }
}
