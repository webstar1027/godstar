<?php

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
        $user = new App\User;
        $user->name = "test User";
        $user->email = "testemail@gmail.com";
        $user->password = \Illuminate\Support\Facades\Hash::make("testing");
        $user->save();
    }
}
