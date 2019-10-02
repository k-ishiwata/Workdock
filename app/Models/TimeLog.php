<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TimeLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'start_at', 'time', 'user_id', 'project_id'
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime'
    ];

    protected $with = ['user'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class)->withDefault();
    }

    /**
     * バーの長さ（スタイル）を出力
     */
    public function getBarStyleAttribute()
    {
        // マスのサイズ
        $width = 30;

        // 開始時間
        $startTime = $this->start_at->format('H') * $width;
        $startTime += $this->start_at->format('i') * 0.5;
        // 終了時間（バーの長さ）
        $endTime = ($this->time / 60) * $width;

        echo 'style="left:' . $startTime. 'px; width:' . $endTime. 'px;"';
    }

    public function getEndAtAttribute()
    {
        return $this->start_at->addMinutes($this->time);
    }
}
