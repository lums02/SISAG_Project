<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AcademyController extends Controller
{
    public function index(): View
    {
        return view('academy');
    }
}
