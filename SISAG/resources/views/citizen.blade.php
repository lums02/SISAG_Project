@extends('layouts.app', ['title' => 'Espace citoyen'])

@section('content')
    <div class="max-w-4xl">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 tracking-tight">Espace citoyen</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
            Donnez votre avis, votez pour les projets prioritaires ou signalez des retards.
        </p>
    </div>

    <section id="feedback" class="mt-8 grid gap-6 lg:grid-cols-2">
        <form method="POST" action="{{ route('citizen.feedback') }}" class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 space-y-4">
            @csrf
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 tracking-tight">Contribuer</h2>
            <div>
                <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Projet (ID)</label>
                <input type="number" name="project_id" value="{{ old('project_id') }}" 
                       class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Bientôt remplacé par une liste déroulante.</p>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Nom</label>
                    <input type="text" name="citizen_name" value="{{ old('citizen_name') }}" 
                           class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
                </div>
                <div>
                    <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Email</label>
                    <input type="email" name="citizen_email" value="{{ old('citizen_email') }}" 
                           class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
                </div>
            </div>
            <div>
                <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Type de contribution</label>
                <select name="type" 
                        class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
                    @foreach (['feedback' => 'Feedback', 'vote' => 'Vote', 'signalement' => 'Signalement'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('type') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Commentaire</label>
                <textarea name="comment" rows="4" 
                          class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">{{ old('comment') }}</textarea>
            </div>
            <div>
                <label class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide mb-1.5 block">Score (0 à 100)</label>
                <input type="number" name="score" value="{{ old('score') }}" min="0" max="100" 
                       class="mt-1 w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600 focus:border-transparent transition-colors duration-150">
            </div>
            <button class="w-full bg-emerald-600 dark:bg-emerald-500 text-white dark:text-gray-900 rounded-md px-4 py-2.5 text-sm font-medium hover:bg-emerald-500 dark:hover:bg-emerald-400 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-emerald-200 dark:focus:ring-emerald-700">Envoyer</button>
        </form>

        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 tracking-tight">Derniers retours</h2>
            <ul class="space-y-4">
                @forelse ($latestFeedbacks as $feedback)
                    <li class="p-4 border border-gray-200 dark:border-gray-700 rounded-md bg-white dark:bg-gray-900">
                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $feedback->citizen_name ?? 'Contributeur anonyme' }}</p>
                        <p class="text-xs uppercase text-gray-500 dark:text-gray-400 mt-0.5 font-medium">{{ ucfirst($feedback->type) }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed">{{ $feedback->comment ?? '—' }}</p>
                    </li>
                @empty
                    <li class="text-sm text-gray-500 dark:text-gray-400">Pas encore de contributions.</li>
                @endforelse
            </ul>
        </div>
    </section>
@endsection

