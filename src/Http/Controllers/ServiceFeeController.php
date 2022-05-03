<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Eutranet\Corporate\Models\ServiceFee;
use function view;

/**
 * The service fee controller is to be used for marketing purposes.
 * Public functions are to be customized according each service purpose and needs...
 * Todo discuss this with the marketeer
 */
class ServiceFeeController extends Controller
{
    /**
     * @param ServiceFee $serviceFee
     * @return Factory|View|Application
     */
    public function show(ServiceFee $serviceFee): Factory|View|Application
    {
        return $this->index();
    }

    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        return view('front.services.index', [
            'serviceFees' => ServiceFee::all(),
            'header' => __('Services')
        ]);
    }
}
