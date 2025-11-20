<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'ministry',
        'sector',
        'region',
        'budget',
        'status',
        'progress',
        'transparency_score',
        'objectives',
        'description',
        'responsable',
        'location',
        'start_date',
        'end_date',
        'metadata',
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'progress' => 'integer',
        'transparency_score' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'metadata' => 'array',
    ];

    public function timelines(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }

    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Calcule automatiquement le score de transparence basé sur :
     * - Complétude des données (40%)
     * - Respect des délais (30%)
     * - Feedback citoyen (30%)
     */
    public function calculateTransparencyScore(): int
    {
        $score = 0;

        // Complétude des données (40 points max)
        $completeness = 0;
        $fields = ['title', 'objectives', 'description', 'budget', 'start_date', 'end_date', 'responsable', 'location'];
        $filledFields = 0;
        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filledFields++;
            }
        }
        $completeness = ($filledFields / count($fields)) * 40;
        $score += $completeness;

        // Respect des délais (30 points max)
        $timelineScore = 0;
        $timelines = $this->timelines;
        if ($timelines->count() > 0) {
            $onTimeCount = 0;
            $totalTimelines = $timelines->count();
            foreach ($timelines as $timeline) {
                if ($timeline->status === 'livre' && $timeline->due_date && $timeline->completed_at) {
                    if ($timeline->completed_at <= $timeline->due_date) {
                        $onTimeCount++;
                    }
                } elseif ($timeline->status === 'en_cours' || $timeline->status === 'prevu') {
                    // En cours ou prévu = pas encore de retard
                    if (!$timeline->due_date || $timeline->due_date >= now()) {
                        $onTimeCount++;
                    }
                }
            }
            $timelineScore = ($onTimeCount / $totalTimelines) * 30;
        } else {
            // Pas de timeline = pénalité
            $timelineScore = 10;
        }
        $score += $timelineScore;

        // Feedback citoyen (30 points max)
        $feedbackScore = 0;
        $feedbacks = $this->feedbacks;
        if ($feedbacks->count() > 0) {
            $avgScore = $feedbacks->whereNotNull('score')->avg('score') ?? 0;
            $feedbackScore = ($avgScore / 100) * 30;
            // Bonus pour le nombre de feedbacks
            $feedbackCount = min($feedbacks->count(), 10);
            $feedbackScore += ($feedbackCount / 10) * 5; // Max 5 points bonus
            $feedbackScore = min($feedbackScore, 30);
        } else {
            // Pas de feedback = pénalité
            $feedbackScore = 5;
        }
        $score += $feedbackScore;

        return (int) round(min($score, 100));
    }

    /**
     * Met à jour le score de transparence automatiquement
     */
    public function updateTransparencyScore(): void
    {
        $this->transparency_score = $this->calculateTransparencyScore();
        $this->save();
    }
}
