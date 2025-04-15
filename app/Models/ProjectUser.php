<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ProjectUser extends Model
{
    use HasFactory;

    protected $table = 'projects_users';

    protected $fillable = [
        'user_id',
        'project_id',
    ];
}
