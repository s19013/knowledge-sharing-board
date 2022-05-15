<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class RoomMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_members')->insert([
            'room_id' => 12,
            'member_id' => 9,
        ]);

        DB::table('room_members')->insert([
            'room_id' => 10,
            'member_id' => 7,
        ]);

        DB::table('room_members')->insert([
            'room_id' => 11,
            'member_id' => 8,
        ]);
    }
}
