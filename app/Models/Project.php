<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'summary',
        'department_id',
        'status',
    ];

    /**
     * Получить тэги проекта
     *
     * @return HasManyThrough
     */
    public function tags(): HasManyThrough
    {
        return $this->hasManyThrough(Tag::class, ProjectTag::class, 'project_id', 'id',
            'id', 'tag_id');
    }

    /**
     * Получить пользователей проекта
     *
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, ProjectUser::class, 'project_id', 'id',
            'id', 'user_id');
    }

    /**
     * Получить комментарии проекта
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'project_id', 'id');
    }
}
