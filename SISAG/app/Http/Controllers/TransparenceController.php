<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\JsonResponse;

class TransparenceController extends Controller
{
    public function show(Project $project): JsonResponse
    {
        $score = $project->transparency_score;

        return response()->json([
            'project_id' => $project->id,
            'score' => $score,
            'level' => $this->scoreToLevel($score),
            'updated_at' => $project->updated_at,
        ]);
    }

    private function scoreToLevel(int $score): string
    {
        return match (true) {
            $score >= 80 => 'excellent',
            $score >= 60 => 'bon',
            $score >= 40 => 'moyen',
            default => 'faible',
        };
    }
}
