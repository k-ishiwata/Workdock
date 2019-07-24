<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'time'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // 分を00:00フォーマットにして返す
    public function getTimeFormatAttribute()
    {
        $hour = floor( $this->time / 60 ) % 60;
        $min = floor( $this->time % 60 );

        return sprintf('%02d', $hour) . ':' . sprintf('%02d', $min);
    }
}
