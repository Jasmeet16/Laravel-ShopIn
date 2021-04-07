<?php

use Illuminate\Database\Seeder;
use App\Profile;
use App\User;

class AdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'admin' => true,
        ]);

        Profile::create([
            'name' => 'admin',
            'user_id' => $user->id
        ]);
    }
}
