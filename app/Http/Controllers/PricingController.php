<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
//        $this->authorize('viewAny', [User::class, 'teacher']);

        return view('pages.pricing.index');
    }
}
