<?php

namespace Eutranet\Corporate\Http\Controllers;

use App\Http\Controllers\Controller;
use Eutranet\Corporate\Traits\CorporateUsersTrait;

class SearchUserController extends Controller
{
    use CorporateUsersTrait;

    public function __construct()
    {
        // $this->middleware(['auth:staff']);
    }
}
