<?php

namespace App\Http\Controllers;

class PricingController extends Controller
{
    public function index()
    {
        // $this->authorize('viewAny', [User::class, 'teacher']);
        return view('pages.pricing.index');
    }

    public function connectPaypalSuccess()
    {

    }

    public function connectPaypalCancel()
    {

    }
}
