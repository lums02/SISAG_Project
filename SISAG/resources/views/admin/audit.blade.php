@extends('layouts.app', ['title' => 'Journal d'audit'])

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-2 tracking-tight">Journal d'audit</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Historique des actions réalisées par les agents SISAG.</p>

        <div class="mt-6 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-white dark:bg-gray-900 text-xs uppercase text-gray-500 dark:text-gray-400 font-medium border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Agent</th>
                        <th class="px-4 py-3 text-left">Action</th>
                        <th class="px-4 py-3 text-left">Objet</th>
                        <th class="px-4 py-3 text-left">IP</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr class="border-t border-gray-200 dark:border-gray-700 hover:bg-white dark:hover:bg-gray-900/50 transition-colors duration-150">
                            <td class="px-4 py-3 text-gray-600 dark:text-gray-400">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 text-gray-900 dark:text-gray-100 font-medium">{{ $log->user->name ?? $log->performed_by ?? 'Système' }}</td>
                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">{{ $log->action }}</td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400 text-xs">{{ class_basename($log->auditable_type) }} #{{ $log->auditable_id }}</td>
                            <td class="px-4 py-3 text-gray-500 dark:text-gray-400">{{ $log->ip_address ?? '—' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">Aucune entrée pour l'instant.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
@endsection

