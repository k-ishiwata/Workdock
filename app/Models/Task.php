<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $fillable = [
        'title', 'status_id', 'priority_id', 'project_id', 'due_at', 'start_at', 'time', 'user_id'
    ];

    protected $casts = [
        'project_id' => 'integer',
        'status_id' => 'integer',
        'priority_id' => 'integer',
//        'due_at' => 'datetime:Y-m-d H:i:s',
//        'start_at' => 'datetime:Y-m-d H:i'
        'due_at' => 'datetime',
        'start_at' => 'datetime'
    ];

//    protected $dates = [
//        'due_at', 'start_at'
//    ];

//    protected $dateFormat = 'Y-m-d H:i';

    /**
     * デフォルト値
     * @var array
     */
    protected $attributes = [
        'status_id' => 1,
        'time' => 0,
        'priority_id' => 0
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // 期日のフォーマット
    public function setDueAtAttribute($value)
    {
        $this->attributes['due_at'] = $value ? Carbon::createFromFormat('Y-m-d H:i', $value) : null;
    }
}
