<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use DB;
use Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'りんご',
            'email' => 'apple@example.com',
            'password' => Hash::make('00000000'),
        ]);
        DB::table('users')->insert([
            'name' => 'Q-jack',
            'email' => 'peacock@example.com',
            'password' => Hash::make('00000000'),
        ]);
        DB::table('users')->insert([
            'name' => 'mimi',
            'email' => 'mimi@popnmusic.com',
            'password' => Hash::make('00000000'),
        ]);
        DB::table('users')->insert([
            'name' => 'rage',
            'email' => 'rage@dancedancerevolution.com',
            'password' => Hash::make('00000000'),
        ]);
    }
}
