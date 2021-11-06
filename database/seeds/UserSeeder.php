<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\RoleUser;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		User::create([
			'id'   => 1,
	        'name' => 'Admin',
	        'email' => 'admin@gmail.com',
            'email_verified_at' => 1,
            'password' => '$2y$10$43Lgdx7qDxGdj3cDyfcw4uLj5nVQ6vsQ3obexrb/axByYf4B6roZO', // secret
            'phone_number' => '029292162',
            'block' => 0,
            'verified' => 2,
            'remember_token' => str_random(10),
            'sign_date' => date('y-m-d h:m:s'),
		]);

        Role::create([
            'id' => 1,
            'name' => 'admin' 
        ]);
        Role::create([
            'id' => 2,
            'name' => 'seller' 
        ]);
        Role::create([
            'id' => 3,
            'name' => 'buyer' 
        ]);
        Role::create([
            'id' => 4,
            'name' => 'manager' 
        ]);

        RoleUser::create([
            'id' => 1,
            'user_id' => 1,
            'role_id' => 1,
        ]);
    }
}
