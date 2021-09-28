<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'start_time',
        'stop_time',
        'elapsed_time',
        'log',
      ];
    protected $casts = [
        'log' => 'array',

    ];
}
