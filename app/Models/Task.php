<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_completed',
        'due_date',
    ];

    public function tags()
    {
        return $this->hasManyThrough(
            Tag::class,
            TaskTag::class,
            'task_id',
            'id',
            'id',
            'tag_id'
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
