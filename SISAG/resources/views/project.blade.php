@extends('layouts.app', ['title' => $project->title])

@section('content')
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-sm text-emerald-600 dark:text-emerald-300 hover:text-emerald-700 dark:hover:text-emerald-200 transition-colors duration-150">&larr; Retour au tableau de bord</a>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <section class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 lg:col-span-2">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase text-gray-500 dark:text-gray-400 font-medium tracking-wide">{{ $project->ministry }}</p>
                    <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mt-1 tracking-tight">{{ $project->title }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $project->sector ?? 'Secteur non défini' }}</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-medium bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 capitalize">
                    {{ str_replace('_', ' ', $project->status) }}
                </span>
            </div>

            <dl class="grid sm:grid-cols-2 gap-4 mt-6 text-sm">
                <div>
                    <dt class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wide mb-1">Budget</dt>
                    <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $project->budget ? number_format($project->budget, 2, ',', ' ') . ' $' : 'Non renseigné' }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wide mb-1">Responsable</dt>
                    <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $project->responsable ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wide mb-1">Localisation</dt>
                    <dd class="font-medium text-gray-900 dark:text-gray-100">{{ $project->location ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 dark:text-gray-400 text-xs uppercase tracking-wide mb-1">Période</dt>
                    <dd class="font-medium text-gray-900 dark:text-gray-100">
                        {{ optional($project->start_date)->format('d/m/Y') ?? '—' }} —
                        {{ optional($project->end_date)->format('d/m/Y') ?? '—' }}
                    </dd>
                </div>
            </dl>

            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 tracking-tight">Objectifs</h2>
                <p class="text-gray-600 dark:text-gray-400 whitespace-pre-line leading-relaxed">{{ $project->objectives ?? 'Objectifs en cours de rédaction.' }}</p>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2 tracking-tight">Description</h2>
                <p class="text-gray-600 dark:text-gray-400 whitespace-pre-line leading-relaxed">{{ $project->description ?? 'Description en cours de rédaction.' }}</p>
            </div>
        </section>

        <aside class="space-y-6">
            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 tracking-tight mb-4">Transparence</h2>
                
                @php
                    $score = $project->transparency_score;
                    $level = match(true) {
                        $score >= 80 => ['label' => 'Excellent', 'color' => 'emerald'],
                        $score >= 60 => ['label' => 'Bon', 'color' => 'blue'],
                        $score >= 40 => ['label' => 'Moyen', 'color' => 'amber'],
                        default => ['label' => 'Faible', 'color' => 'rose'],
                    };
                    $strokeColor = match(true) {
                        $score >= 80 => 'stroke-emerald-500',
                        $score >= 60 => 'stroke-blue-500',
                        $score >= 40 => 'stroke-amber-500',
                        default => 'stroke-rose-500',
                    };
                    $textColor = match(true) {
                        $score >= 80 => 'text-emerald-600 dark:text-emerald-300',
                        $score >= 60 => 'text-blue-600 dark:text-blue-300',
                        $score >= 40 => 'text-amber-600 dark:text-amber-300',
                        default => 'text-rose-600 dark:text-rose-300',
                    };
                    $circumference = 2 * pi() * 45; // rayon = 45
                    $offset = $circumference - ($score / 100) * $circumference;
                @endphp
                
                <div class="flex flex-col items-center">
                    <div class="relative w-32 h-32">
                        <svg class="transform -rotate-90 w-32 h-32">
                            <circle cx="64" cy="64" r="45" stroke="currentColor" stroke-width="8" fill="none" class="text-gray-200 dark:text-gray-700"></circle>
                            <circle cx="64" cy="64" r="45" stroke="currentColor" stroke-width="8" fill="none" 
                                    stroke-dasharray="{{ $circumference }}" 
                                    stroke-dashoffset="{{ $offset }}"
                                    stroke-linecap="round"
                                    class="{{ $strokeColor }} transition-all duration-1000 ease-out"></circle>
                        </svg>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <p class="text-3xl font-bold {{ $textColor }}">{{ $score }}</p>
                                <p class="text-xs {{ $textColor }}">%</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-4 text-sm font-medium {{ $textColor }}">{{ $level['label'] }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 text-center">Score basé sur complétude, délais et feedback citoyen.</p>
                </div>
                
                <a href="{{ route('citizen.index') }}#feedback" class="inline-flex mt-4 text-sm text-emerald-600 dark:text-emerald-300 hover:text-emerald-700 dark:hover:text-emerald-200 font-medium transition-colors duration-150">Donner un avis</a>
            </div>

            <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 uppercase tracking-wide">Progression</h3>
                <div class="mt-3">
                    <div class="h-2 rounded-full bg-gray-200 dark:bg-gray-700">
                        <div class="h-2 rounded-full bg-emerald-500 dark:bg-emerald-400 transition-all duration-300" style="width: {{ $project->progress }}%"></div>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 font-medium">{{ $project->progress }}% livrés</p>
                </div>
            </div>
        </aside>
    </div>

    <section class="mt-10 grid gap-6 lg:grid-cols-2">
        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 tracking-tight">Timeline interactive</h2>
                <span class="text-xs text-gray-500 dark:text-gray-400">Jalons et livrables</span>
            </div>
            
            @php
                $timelines = $project->timelines()->orderBy('due_date')->get();
            @endphp
            
            @if($timelines->count() > 0)
                <div class="relative">
                    <!-- Ligne verticale de la timeline -->
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-300 dark:bg-gray-600"></div>
                    
                    <ul class="space-y-6 relative">
                        @foreach($timelines as $index => $timeline)
                            @php
                                $statusColors = [
                                    'livre' => ['bg' => 'bg-emerald-500', 'border' => 'border-emerald-500', 'text' => 'text-emerald-700 dark:text-emerald-300'],
                                    'en_cours' => ['bg' => 'bg-blue-500', 'border' => 'border-blue-500', 'text' => 'text-blue-700 dark:text-blue-300'],
                                    'retard' => ['bg' => 'bg-amber-500', 'border' => 'border-amber-500', 'text' => 'text-amber-700 dark:text-amber-300'],
                                    'bloque' => ['bg' => 'bg-rose-500', 'border' => 'border-rose-500', 'text' => 'text-rose-700 dark:text-rose-300'],
                                    'prevu' => ['bg' => 'bg-gray-400', 'border' => 'border-gray-400', 'text' => 'text-gray-600 dark:text-gray-400'],
                                ];
                                $color = $statusColors[$timeline->status] ?? $statusColors['prevu'];
                                $isLate = $timeline->due_date && $timeline->due_date < now() && $timeline->status !== 'livre';
                            @endphp
                            
                            <li class="relative pl-12 group cursor-pointer" onclick="toggleTimelineDetails({{ $index }})">
                                <!-- Point de la timeline -->
                                <div class="absolute left-0 top-1.5 w-8 h-8 flex items-center justify-center">
                                    <div class="w-4 h-4 rounded-full {{ $color['bg'] }} border-2 border-white dark:border-gray-800 shadow-sm group-hover:scale-125 transition-transform duration-200"></div>
                                </div>
                                
                                <!-- Contenu du jalon -->
                                <div class="bg-white dark:bg-gray-900 border {{ $color['border'] }} border-l-4 rounded-md p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-sm">{{ $timeline->milestone }}</h3>
                                            @if($timeline->due_date)
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                    Échéance : {{ $timeline->due_date->format('d/m/Y') }}
                                                    @if($isLate)
                                                        <span class="ml-2 text-amber-600 dark:text-amber-400 font-medium">⚠ En retard</span>
                                                    @endif
                                                </p>
                                            @endif
                                            @if($timeline->completed_at)
                                                <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-1">
                                                    ✓ Livré le {{ $timeline->completed_at->format('d/m/Y') }}
                                                </p>
                                            @endif
                                        </div>
                                        <span class="ml-3 px-2 py-1 text-xs font-medium rounded {{ $color['text'] }} bg-opacity-10 capitalize">
                                            {{ str_replace('_', ' ', $timeline->status) }}
                                        </span>
                                    </div>
                                    
                                    <!-- Détails (cachés par défaut) -->
                                    <div id="timeline-details-{{ $index }}" class="hidden mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                        @if($timeline->notes)
                                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $timeline->notes }}</p>
                                        @endif
                                        @if($timeline->attachments && count($timeline->attachments) > 0)
                                            <div class="mt-2">
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Pièces jointes :</p>
                                                <ul class="text-xs text-emerald-600 dark:text-emerald-400 space-y-1">
                                                    @foreach($timeline->attachments as $attachment)
                                                        <li>• {{ $attachment }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-8">Aucun jalon enregistré pour le moment.</p>
            @endif
        </div>

        <div class="bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 tracking-tight">Feedback citoyen</h2>
                <a href="{{ route('citizen.index') }}#feedback" class="text-xs text-emerald-600 dark:text-emerald-300 hover:text-emerald-700 dark:hover:text-emerald-200 font-medium transition-colors duration-150">Contribuer</a>
            </div>
            <ul class="space-y-4">
                @forelse ($project->feedbacks()->latest()->take(5)->get() as $feedback)
                    <li class="p-4 border border-gray-200 dark:border-gray-700 rounded-md bg-white dark:bg-gray-900">
                        <p class="text-sm text-gray-900 dark:text-gray-100 font-medium">{{ $feedback->citizen_name ?? 'Contributeur anonyme' }}</p>
                        <p class="text-xs uppercase text-gray-500 dark:text-gray-400 mt-0.5 font-medium">{{ ucfirst($feedback->type) }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2 leading-relaxed">{{ $feedback->comment ?? '—' }}</p>
                    </li>
                @empty
                    <li class="text-sm text-gray-500 dark:text-gray-400">Pas encore de retours.</li>
                @endforelse
            </ul>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    function toggleTimelineDetails(index) {
        const details = document.getElementById('timeline-details-' + index);
        if (details) {
            details.classList.toggle('hidden');
        }
    }
</script>
@endpush
