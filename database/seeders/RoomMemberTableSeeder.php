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
            'room_id' => 2,//アニメ
            'member_id' => 2,//q-jack
        ]);

        DB::table('room_members')->insert([
            'room_id' => 3,//音楽
            'member_id' => 3,//mimi
        ]);

        DB::table('room_members')->insert([
            'room_id' => 4,//ダンス
            'member_id' => 4,//rage
        ]);
    }
}
