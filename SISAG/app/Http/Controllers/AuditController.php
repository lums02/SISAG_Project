<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\View\View;

class AuditController extends Controller
{
    public function index(): View
    {
        return view('admin.audit', [
            'logs' => AuditLog::with('user')->latest()->paginate(25),
        ]);
    }
}
