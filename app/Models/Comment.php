<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'user_fullname',
        'body',
        'votes',
        'status',
    ];

    protected static function booted(): void
    {
        static::created(function (Comment $comment) {
            $project = $comment->project;
            $project->updated_at = now();
            $project->status = 'active';
            $project->save();
        });
    }

    /**
     * Получить заметки к комментарию
     *
     * @return HasMany
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'comment_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
