<?php

use Illuminate\Database\Seeder;
use Thunderlabid\Auths\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create(['name'	=> 'Agil Ma', 'email' => 'agil@thunderlab.id', 'password' => '123qwe']);
    }
}
