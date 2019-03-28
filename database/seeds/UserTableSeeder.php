<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name', 'employee')->first();
        $role_manager = Role::where('name', 'admin')->first();

        $employee = new User();
        $employee->name = 'Employee Name';
        $employee->email = 'employee@example.com';
        $employee->password = bcrypt('secret');
        $employee->api_token = "c8Yo4FDNVxRwqg5bEe7kG62oAPWv59RohVkpjHZDiXqFSNy9RhK75oAZjk2G";
        $employee->save();
        $employee->roles()->attach($role_employee);

        $manager = new User();
        $manager->name = 'Admin user';
        $manager->email = 'admin@example.com';
        $manager->password = bcrypt('secret');
        $manager->api_token = "c8Yo4FDNVxRwqg5bEe7kG62oAPWv59RohVkpjHZDiXqFSNy9RhK75oAZjk2F";
        $manager->save();
        $manager->roles()->attach($role_manager);
        $manager->roles()->attach($role_employee);

        $manager = new User();
        $manager->name = 'Daniel Stuhr Petersen';
        $manager->email = 'd@stuhrs.dk';
        $manager->password = bcrypt('daniel123');
        $manager->api_token = "c8Yo4FDNVxRwqg5bEe7kG62oAPWv59RohVkpjHZggXqFSNy9RhK75oAZjk2F";
        $manager->save();
        $manager->roles()->attach($role_manager);
        $manager->roles()->attach($role_employee);


        $manager = new User();
        $manager->name = 'Kuddi';
        $manager->email = 'kuddi@mail.com';
        $manager->password = bcrypt('password123');
        $manager->api_token = "c9Yo4FDNVxRwqg5bEe7kG62oAPWv59RohVkpjHZggXqFSNy9RhK75oAZjk2F";
        $manager->save();
        $manager->roles()->attach($role_manager);
        $manager->roles()->attach($role_employee);

        $manager = new User();
        $manager->name = 'Asger';
        $manager->email = 'asger@mail.com';
        $manager->password = bcrypt('password123');
        $manager->api_token =Str::random(60);
        $manager->save();
        $manager->roles()->attach($role_manager);
        $manager->roles()->attach($role_employee);

        $manager = new User();
        $manager->name = 'Frederik';
        $manager->email = 'frederik@mail.com';
        $manager->password = bcrypt('password123');
        $manager->api_token =Str::random(60);
        $manager->save();
        $manager->roles()->attach($role_manager);
        $manager->roles()->attach($role_employee);

        $manager = new User();
        $manager->name = 'Andreas';
        $manager->email = 'andreas@mail.com';
        $manager->password = bcrypt('password123');
        $manager->api_token =Str::random(60);
        $manager->save();
        $manager->roles()->attach($role_manager);
        $manager->roles()->attach($role_employee);

    }
}
