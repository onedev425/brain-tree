<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function index()
    {
        return view('pages.marks.index');
    }
}
