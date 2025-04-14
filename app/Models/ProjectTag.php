<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ProjectTag extends Model
{
    use HasFactory;

    protected $table = 'projects_tags';

    protected $fillable = [
        'tag_id',
        'project_id',
    ];
}
