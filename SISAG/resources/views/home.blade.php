@extends('layouts.app', ['title' => 'Accueil'])

@section('content')
    <div class="grid gap-6 md:grid-cols-2">
        <section class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-2 tracking-tight">Bienvenue sur SISAG Pulse</h1>
            <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">
                Interface de suivi des projets gouvernementaux : transparence, évaluation et participation citoyenne.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 dark:bg-emerald-500 text-white dark:text-gray-900 rounded-md shadow-sm hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-colors duration-150 text-sm font-medium">
                    Accéder au tableau de bord
                </a>
                <a href="{{ route('citizen.index') }}" class="inline-flex items-center px-4 py-2.5 border border-emerald-200 dark:border-emerald-700 text-emerald-700 dark:text-emerald-200 rounded-md hover:bg-emerald-50 dark:hover:bg-emerald-900/30 transition-colors duration-150 text-sm font-medium">
                    Contribuer comme citoyen
                </a>
            </div>
        </section>

        <section class="bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 tracking-tight">Statistiques globales</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-white dark:bg-gray-900 rounded-md border border-gray-200 dark:border-gray-700 text-center">
                    <dt class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1.5">Projets actifs</dt>
                    <dd class="text-3xl font-semibold text-emerald-600 dark:text-emerald-300">{{ number_format($stats['projects_count']) }}</dd>
                </div>
                <div class="p-4 bg-white dark:bg-gray-900 rounded-md border border-gray-200 dark:border-gray-700 text-center">
                    <dt class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-1.5">Score de transparence moyen</dt>
                    <dd class="text-3xl font-semibold text-emerald-600 dark:text-emerald-300">{{ $stats['avg_transparency'] }}%</dd>
                </div>
            </dl>
        </section>
    </div>
@endsection

