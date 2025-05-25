<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskTag extends Model
{
    protected $fillable = [
        'task_id',
        'tag_id'
    ];
}
