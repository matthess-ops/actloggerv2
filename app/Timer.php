<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'main_activities',
        'sub_activities',
        'fixed_activities',
        'experiments',
        'previous_log',
        'timer_running',
        'start_time',
        'selected_main_activity',
        'selected_sub_activity',
        'selected_scaled_activities',
        'selected_fixed_activities',
      ];
    protected $casts = [
        'main_activities' => 'array',
        'sub_activities' => 'array',
        'fixed_activities' => 'array',
        'experiments' => 'array',
        'scaled_activities' => 'array',
        'previous_log' => 'array',
        'selected_scaled_activities' => 'array',
        'selected_fixed_activities' => 'array',

    ];




}
