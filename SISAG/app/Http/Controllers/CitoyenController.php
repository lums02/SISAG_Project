<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CitoyenController extends Controller
{
    public function index(): View
    {
        return view('citizen', [
            'latestFeedbacks' => Feedback::latest()->take(10)->get(),
        ]);
    }

    public function storeFeedback(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'project_id' => ['nullable', 'exists:projects,id'],
            'citizen_name' => ['nullable', 'string', 'max:255'],
            'citizen_email' => ['nullable', 'email', 'max:255'],
            'type' => ['required', 'in:feedback,vote,signalement'],
            'comment' => ['nullable', 'string'],
            'score' => ['nullable', 'integer', 'between:0,100'],
        ]);

        Feedback::create($data + ['status' => 'nouveau']);

        return back()->with('status', 'Merci pour votre contribution !');
    }
}
