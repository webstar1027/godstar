<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'HipRez Admin',
            'email' => 'hiprezadmin@gmail.com',
            'password' => bcrypt('hiprez'),
            'provider' => 'admin'
        ]);
    }
}
