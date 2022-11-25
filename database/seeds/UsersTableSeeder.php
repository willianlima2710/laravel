<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      =>  'Willian de Lima',
            'email'     =>  'willian@empsoft.com.br',
            'password'  =>  bcrypt('dev2710'),
        ]);            
    }
}
