<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Log
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $user_id
 * @property string|null $start_time
 * @property string|null $stop_time
 * @property int $elapsed_time
 * @property array $log
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereElapsedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereStopTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUserId($value)
 */
	class Log extends \Eloquent {}
}

namespace App{
/**
 * App\Post
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $user_id
 * @property string $title
 * @property string $content
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 */
	class Post extends \Eloquent {}
}

namespace App{
/**
 * App\Timer
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $user_id
 * @property array $main_activities
 * @property array $sub_activities
 * @property array $scaled_activities
 * @property array $fixed_activities
 * @property array $experiments
 * @property array $previous_log
 * @property int $timer_running
 * @property string|null $start_time
 * @property string $selected_main_activity
 * @property string $selected_sub_activity
 * @property array $selected_scaled_activities
 * @property array $selected_fixed_activities
 * @property string $selected_experiment
 * @method static \Illuminate\Database\Eloquent\Builder|Timer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereExperiments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereFixedActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereMainActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer wherePreviousLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereScaledActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereSelectedExperiment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereSelectedFixedActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereSelectedMainActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereSelectedScaledActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereSelectedSubActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereSubActivities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereTimerRunning($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timer whereUserId($value)
 */
	class Timer extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

