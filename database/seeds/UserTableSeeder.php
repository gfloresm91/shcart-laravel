<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

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
        $user = new \shcart\User(
           [   
               'name' => 'Test',
               'email' => 'test@test.com',
               'password' => Hash::make('test')
           ]);
        $user->save();
    }
}
