<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class HistoriqueController extends Controller
{
    public function index(): View
    {
        $projects = Project::where('status', 'termine')
            ->orderByDesc('end_date')
            ->paginate(15);

        return view('history', compact('projects'));
    }
}
