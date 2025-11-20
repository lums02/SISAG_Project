@extends('layouts.app', ['title' => 'Historique des projets'])

@section('content')
    <div class="max-w-5xl">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 tracking-tight">Historique des projets</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Projets terminés triés par date d'achèvement.</p>
    </div>

    <div class="mt-6 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm divide-y divide-gray-200 dark:divide-gray-700">
        @forelse ($projects as $project)
            <article class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-3 hover:bg-white dark:hover:bg-gray-900 transition-colors duration-150">
                <div>
                    <p class="text-sm uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide">{{ $project->ministry }}</p>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mt-1 tracking-tight">{{ $project->title }}</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $project->region ?? 'Couverture nationale' }}</p>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">
                    Terminé le {{ optional($project->end_date)->format('d/m/Y') ?? '—' }}
                </div>
            </article>
        @empty
            <p class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">Aucun projet terminé pour l'instant.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
@endsection

