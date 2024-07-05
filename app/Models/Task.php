<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
        'complete_till' => 'datetime'
    ];

    protected static function booted()
    {
        static::creating(function(Task $task) {
            $task->status = false;
        });
    }
}
