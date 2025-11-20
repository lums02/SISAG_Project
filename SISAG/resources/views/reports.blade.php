@extends('layouts.app', ['title' => 'Rapports automatiques'])

@section('content')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-start">
        <section class="flex-1 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4 tracking-tight">Rapports disponibles</h1>
            <div class="space-y-4">
                @forelse ($reports as $report)
                    <article class="border border-gray-200 dark:border-gray-700 rounded-md p-4 bg-white dark:bg-gray-900 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <p class="font-medium text-gray-900 dark:text-gray-100">{{ $report->title }}</p>
                                    <span class="text-xs px-2.5 py-1 rounded-md bg-emerald-50 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-200 capitalize font-medium border border-emerald-100 dark:border-emerald-800">{{ $report->status }}</span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $report->project->title ?? 'Projet supprimé' }}</p>
                                @if($report->summary)
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed">{{ \Illuminate\Support\Str::limit($report->summary, 160) }}</p>
                                @endif
                                @if($report->metrics)
                                    <div class="mt-3 flex gap-4 text-xs text-gray-500 dark:text-gray-400">
                                        <span>Progression: {{ $report->metrics['progress'] ?? 0 }}%</span>
                                        <span>Transparence: {{ $report->metrics['transparency_score'] ?? 0 }}/100</span>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 flex gap-2">
                                <a href="{{ route('reports.view', $report) }}" target="_blank" 
                                   class="px-3 py-1.5 text-xs font-medium text-emerald-600 dark:text-emerald-300 hover:text-emerald-700 dark:hover:text-emerald-200 border border-emerald-200 dark:border-emerald-800 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-900/40 transition-colors duration-150">
                                    Voir
                                </a>
                                <a href="{{ route('reports.download', $report) }}" 
                                   class="px-3 py-1.5 text-xs font-medium bg-emerald-600 dark:bg-emerald-500 text-white dark:text-gray-900 rounded-md hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-colors duration-150">
                                    Télécharger
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-8">Aucun rapport pour le moment.</p>
                @endforelse
            </div>
            <div class="mt-4">
                {{ $reports->links() }}
            </div>
        </section>

        <section class="w-full lg:w-80 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 tracking-tight">Générer un rapport</h2>
            <form method="POST" action="{{ route('reports.generate') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Projet</label>
                    <select name="project_id" 
                            class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150" required>
                        <option value="">Sélectionner un projet</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }} ({{ $project->ministry }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Titre</label>
                    <input type="text" name="title" 
                           class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150" required>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Début</label>
                        <input type="date" name="period_start" 
                               class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
                    </div>
                    <div>
                        <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Fin</label>
                        <input type="date" name="period_end" 
                               class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
                    </div>
                </div>
                <div>
                    <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Résumé</label>
                    <textarea name="summary" rows="3" 
                              class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150"></textarea>
                </div>
                <button class="w-full bg-emerald-600 dark:bg-emerald-500 text-white dark:text-gray-900 rounded-md px-4 py-2.5 text-sm font-medium hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-200 dark:focus:ring-emerald-700">Lancer</button>
            </form>
        </section>
    </div>
@endsection

