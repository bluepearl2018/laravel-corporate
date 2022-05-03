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

class StaffTeamController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(App\Models\StaffMember::class);
    }
}
