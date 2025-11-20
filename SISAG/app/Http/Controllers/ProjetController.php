<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjetController extends Controller
{
    /**
     * Page d’accueil : résumé rapide + bouton vers dashboard.
     */
    public function home(): View
    {
        $stats = [
            'projects_count' => Project::count(),
            'avg_transparency' => (int) round(Project::avg('transparency_score') ?? 0),
        ];

        return view('home', compact('stats'));
    }

    /**
     * Tableau de bord avec filtres simples.
     */
    public function index(Request $request): View
    {
        $filters = $request->only(['ministry', 'region', 'status']);

        $projectsQuery = Project::query()
            ->when($filters['ministry'] ?? null, fn ($q, $value) => $q->where('ministry', $value))
            ->when($filters['region'] ?? null, fn ($q, $value) => $q->where('region', $value))
            ->when($filters['status'] ?? null, fn ($q, $value) => $q->where('status', $value))
            ->orderByDesc('updated_at');

        return view('dashboard', [
            'projects' => $projectsQuery->paginate(15),
            'filters' => $filters,
        ]);
    }

    /**
     * Fiche projet détaillée.
     */
    public function show(Project $project): View
    {
        // Charger les relations nécessaires
        $project->load(['timelines', 'feedbacks']);
        
        // Mettre à jour le score de transparence si nécessaire
        $project->updateTransparencyScore();
        
        return view('project', compact('project'));
    }
}
