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
        // v1.0
        $this->call(UserSeeder::class);
        // v1.0.1
        $this->call(LogPermissionSeeder::class);
    }
}
