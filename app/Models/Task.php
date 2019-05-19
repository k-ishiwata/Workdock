<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'status_id', 'priority_id', 'due_at', 'start_at', 'time', 'user_id'
    ];
    
//    protected $casts = [
//        'due_at' => 'datetime',
//        'start_at' => 'datetime'
//    ];
    
    // Date型で扱う
    protected $dates = ['due_at', 'start_at'];

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
}
