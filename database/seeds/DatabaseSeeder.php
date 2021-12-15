<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        error_log("databaseseeder runned");



        $this->call([
            // LogSeeder::class,
            TimerSeeder::class,
            // PostSeeder::class,
            // EigenTimerSeeder::class,
            UserSeeder::class,

        ]);    }
}
