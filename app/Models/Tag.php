<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag'
    ];

    /**
     * Получить проекты по тэгам
     *
     * @return HasManyThrough
     */
    public function projects(): HasManyThrough
    {
        return $this->hasManyThrough(Project::class, ProjectTag::class, 'tag_id', 'id', 'id', 'project_id');
    }
}
