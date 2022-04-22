<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = User::create([
		  'first_name' => 'supper',
		  'last_name' => 'admin',
		  'email' => 'super_admin@gmail.com',
		  'password' => bcrypt('123123123'),
	  ]);

	  $user->attachRole('super_admin');
    }
}
