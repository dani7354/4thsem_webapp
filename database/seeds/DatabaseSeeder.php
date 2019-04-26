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
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(DeadlinesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);
        $this->call(MeetingsTableSeeder::class);
    }
}
