<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Timeline;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function show(Project $project): JsonResponse
    {
        return response()->json(
            $project->timelines()->orderBy('due_date')->get()
        );
    }

    public function store(Request $request, Project $project): JsonResponse
    {
        $data = $request->validate([
            'milestone' => ['required', 'string', 'max:255'],
            'due_date' => ['nullable', 'date'],
            'completed_at' => ['nullable', 'date'],
            'status' => ['required', 'in:prevu,en_cours,retard,livre,bloque'],
            'notes' => ['nullable', 'string'],
            'attachments' => ['nullable', 'array'],
        ]);

        $timeline = $project->timelines()->create($data);

        return response()->json($timeline, 201);
    }

    public function update(Request $request, Timeline $timeline): JsonResponse
    {
        $data = $request->validate([
            'milestone' => ['sometimes', 'string', 'max:255'],
            'due_date' => ['sometimes', 'nullable', 'date'],
            'completed_at' => ['sometimes', 'nullable', 'date'],
            'status' => ['sometimes', 'in:prevu,en_cours,retard,livre,bloque'],
            'notes' => ['sometimes', 'nullable', 'string'],
            'attachments' => ['sometimes', 'nullable', 'array'],
        ]);

        $timeline->update($data);

        return response()->json($timeline->fresh());
    }
}
