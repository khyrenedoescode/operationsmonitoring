<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'type',
        'message',
        'detail',
        'user',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
