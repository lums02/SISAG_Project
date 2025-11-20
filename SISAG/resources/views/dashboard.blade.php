@extends('layouts.app', ['title' => 'Tableau de bord'])

@section('content')
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 tracking-tight">Tableau de bord</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Filtrez par ministère, région ou statut pour suivre les projets.</p>
        </div>
        <a href="{{ route('reports.index') }}" class="text-sm text-emerald-600 dark:text-emerald-300 hover:text-emerald-700 dark:hover:text-emerald-200 font-medium transition-colors duration-150">Générer un rapport</a>
    </div>

    <form method="GET" class="grid md:grid-cols-4 gap-4 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm mb-6">
        <div>
            <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Ministère</label>
            <input type="text" name="ministry" value="{{ $filters['ministry'] ?? '' }}" 
                   class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
        </div>
        <div>
            <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Région</label>
            <input type="text" name="region" value="{{ $filters['region'] ?? '' }}" 
                   class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
        </div>
        <div>
            <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Statut</label>
            <select name="status" 
                    class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
                <option value="">Tous</option>
                @foreach (['planifie' => 'Planifié', 'en_cours' => 'En cours', 'retard' => 'Retard', 'bloque' => 'Bloqué', 'termine' => 'Terminé'] as $value => $label)
                    <option value="{{ $value }}" @selected(($filters['status'] ?? '') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end gap-2">
            <button class="flex-1 bg-emerald-600 dark:bg-emerald-500 text-white dark:text-gray-900 rounded-md px-4 py-2 text-sm font-medium hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-200 dark:focus:ring-emerald-700">Filtrer</button>
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors duration-150">Réinitialiser</a>
        </div>
    </form>

    <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400 uppercase text-xs font-medium border-b border-gray-200 dark:border-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Projet</th>
                    <th class="px-4 py-3 text-left">Ministère</th>
                    <th class="px-4 py-3 text-left">Région</th>
                    <th class="px-4 py-3 text-left">Statut</th>
                    <th class="px-4 py-3 text-left">Progression</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-900/50 transition-colors duration-150">
                        <td class="px-4 py-3">
                            <p class="font-medium text-gray-900 dark:text-gray-100">{{ $project->title }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $project->sector ?? 'Secteur non défini' }}</p>
                        </td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $project->ministry }}</td>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $project->region ?? '—' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-200 capitalize border border-emerald-100 dark:border-emerald-800">{{ str_replace('_', ' ', $project->status) }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="h-2 rounded-full bg-emerald-500 dark:bg-emerald-400 transition-all duration-300" style="width: {{ $project->progress }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-medium min-w-[2.5rem] text-right">{{ $project->progress }}%</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('projects.show', $project) }}" class="text-emerald-600 dark:text-emerald-300 hover:text-emerald-700 dark:hover:text-emerald-200 font-medium text-sm transition-colors duration-150">Voir</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Aucun projet ne correspond aux filtres.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
            {{ $projects->withQueryString()->links() }}
        </div>
    </div>
@endsection

