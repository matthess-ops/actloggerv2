<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("user_id");
            $table->json("main_activities");
            $table->json("sub_activities");
            $table->json("scaled_activities");
            $table->json("fixed_activities");
            $table->json("experiments");
            $table->json("previous_log");
            $table->boolean("timer_running");
            $table->timestamp("start_time")->nullable();
            $table->string("selected_main_activity");
            $table->string("selected_sub_activity");
            $table->json("selected_scaled_activities");
            $table->json("selected_fixed_activities");

            $table->string("selected_experiment");






        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timers');
    }
}
