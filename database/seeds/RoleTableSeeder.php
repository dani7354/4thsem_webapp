<?php

use Illuminate\Database\Seeder;
use \App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = "Admin";
        $admin->description = "Can manage users, content etc.";
        $admin->save();

        $user = new Role();
        $user->name = "Employee";
        $user->description = "Employee user";
        $user->save();

    }
}
