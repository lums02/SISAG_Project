<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class RapportController extends Controller
{
    public function index(): View
    {
        return view('reports', [
            'reports' => Report::with('project')->latest()->paginate(15),
            'projects' => Project::orderBy('title')->get(),
        ]);
    }

    public function generate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'string', 'max:255'],
            'period_start' => ['nullable', 'date'],
            'period_end' => ['nullable', 'date', 'after_or_equal:period_start'],
            'summary' => ['nullable', 'string'],
        ]);

        $project = Project::with(['timelines', 'feedbacks'])->findOrFail($data['project_id']);

        // Calculer les métriques
        $metrics = [
            'progress' => $project->progress,
            'transparency_score' => $project->transparency_score,
            'timelines_count' => $project->timelines->count(),
            'timelines_completed' => $project->timelines->where('status', 'livre')->count(),
            'feedbacks_count' => $project->feedbacks->count(),
            'avg_feedback_score' => round($project->feedbacks->whereNotNull('score')->avg('score') ?? 0, 1),
        ];

        $report = Report::create([
            ...$data,
            'status' => 'generated',
            'generated_by' => auth()->user()?->name ?? 'agent_sisag',
            'metrics' => $metrics,
        ]);

        return redirect()
            ->route('reports.index')
            ->with('status', "Rapport généré avec succès pour {$project->title}.");
    }

    public function download(Report $report): Response
    {
        $report->load('project.timelines', 'project.feedbacks');
        
        $pdf = Pdf::loadView('reports.pdf', compact('report'));
        
        return $pdf->download("rapport-{$report->id}-{$report->project->slug}.pdf");
    }

    public function view(Report $report): Response
    {
        $report->load('project.timelines', 'project.feedbacks');
        
        $pdf = Pdf::loadView('reports.pdf', compact('report'));
        
        return $pdf->stream("rapport-{$report->id}.pdf");
    }
}
