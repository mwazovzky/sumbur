<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@hamelius.ru',
            'password' => bcrypt('password'),
        ]);

        factory(User::class)->create([
            'name' => 'user',
            'email' => 'user@hamelius.ru',
            'password' => bcrypt('password'),
        ]);
    }
}
