<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport - {{ $report->title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #1f2937;
        }
        .header {
            background: #10b981;
            color: white;
            padding: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 11px;
            opacity: 0.9;
        }
        .container {
            padding: 0 20px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #10b981;
            border-bottom: 2px solid #10b981;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            font-weight: bold;
            width: 30%;
            padding: 5px 0;
            color: #6b7280;
        }
        .info-value {
            display: table-cell;
            padding: 5px 0;
        }
        .metrics {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        .metrics-row {
            display: table-row;
        }
        .metrics-cell {
            display: table-cell;
            padding: 10px;
            border: 1px solid #e5e7eb;
            text-align: center;
        }
        .metrics-header {
            background: #f3f4f6;
            font-weight: bold;
        }
        .timeline-item {
            margin-bottom: 15px;
            padding: 10px;
            border-left: 3px solid #10b981;
            background: #f9fafb;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-livre { background: #d1fae5; color: #065f46; }
        .status-en_cours { background: #dbeafe; color: #1e40af; }
        .status-retard { background: #fef3c7; color: #92400e; }
        .status-bloque { background: #fee2e2; color: #991b1b; }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SISAG Pulse</h1>
        <p>Rapport d'activité - {{ $report->title }}</p>
    </div>

    <div class="container">
        <div class="section">
            <h2 class="section-title">Informations du rapport</h2>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Projet :</div>
                    <div class="info-value">{{ $report->project->title }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Ministère :</div>
                    <div class="info-value">{{ $report->project->ministry }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Période :</div>
                    <div class="info-value">
                        {{ $report->period_start ? \Carbon\Carbon::parse($report->period_start)->format('d/m/Y') : '—' }} 
                        au 
                        {{ $report->period_end ? \Carbon\Carbon::parse($report->period_end)->format('d/m/Y') : '—' }}
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Généré par :</div>
                    <div class="info-value">{{ $report->generated_by }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Date de génération :</div>
                    <div class="info-value">{{ $report->created_at->format('d/m/Y à H:i') }}</div>
                </div>
            </div>
        </div>

        @if($report->summary)
        <div class="section">
            <h2 class="section-title">Résumé</h2>
            <p>{{ $report->summary }}</p>
        </div>
        @endif

        <div class="section">
            <h2 class="section-title">Métriques du projet</h2>
            <div class="metrics">
                <div class="metrics-row metrics-header">
                    <div class="metrics-cell">Progression</div>
                    <div class="metrics-cell">Score transparence</div>
                    <div class="metrics-cell">Jalons</div>
                    <div class="metrics-cell">Feedback</div>
                </div>
                <div class="metrics-row">
                    <div class="metrics-cell">{{ $report->metrics['progress'] ?? 0 }}%</div>
                    <div class="metrics-cell">{{ $report->metrics['transparency_score'] ?? 0 }}/100</div>
                    <div class="metrics-cell">
                        {{ $report->metrics['timelines_completed'] ?? 0 }}/{{ $report->metrics['timelines_count'] ?? 0 }}
                    </div>
                    <div class="metrics-cell">
                        {{ $report->metrics['feedbacks_count'] ?? 0 }} 
                        @if(isset($report->metrics['avg_feedback_score']))
                            ({{ $report->metrics['avg_feedback_score'] }}/100)
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if($report->project->timelines->count() > 0)
        <div class="section">
            <h2 class="section-title">Timeline du projet</h2>
            @foreach($report->project->timelines as $timeline)
                <div class="timeline-item">
                    <strong>{{ $timeline->milestone }}</strong>
                    <span class="status-badge status-{{ $timeline->status }}">
                        {{ str_replace('_', ' ', $timeline->status) }}
                    </span>
                    @if($timeline->due_date)
                        <br><small>Échéance : {{ $timeline->due_date->format('d/m/Y') }}</small>
                    @endif
                    @if($timeline->completed_at)
                        <br><small>Livré le : {{ $timeline->completed_at->format('d/m/Y') }}</small>
                    @endif
                    @if($timeline->notes)
                        <br><p style="margin-top: 5px;">{{ $timeline->notes }}</p>
                    @endif
                </div>
            @endforeach
        </div>
        @endif

        <div class="footer">
            <p>Rapport généré automatiquement par SISAG Pulse - {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </div>
</body>
</html>

