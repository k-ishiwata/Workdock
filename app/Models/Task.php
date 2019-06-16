<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'status_id', 'priority_id', 'project_id', 'due_at', 'start_at', 'time', 'user_id'
    ];

    protected $casts = [
        'project_id' => 'integer',
        'due_at' => 'datetime:Y-m-d H:i',
        'start_at' => 'datetime:Y-m-d H:i'
    ];

    /**
     * デフォルト値
     * @var array
     */
    protected $attributes = [
        'status_id' => 1,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
