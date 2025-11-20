<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'milestone',
        'due_date',
        'completed_at',
        'status',
        'notes',
        'attachments',
    ];

    protected $casts = [
        'due_date' => 'date',
        'completed_at' => 'date',
        'attachments' => 'array',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
