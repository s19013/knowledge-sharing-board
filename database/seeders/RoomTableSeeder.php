<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;
class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'owner_id' => 2,
            'name' => 'アニメ ゲーム 漫画',
            'comment' => 'なんでもあり!',
        ]);

        DB::table('rooms')->insert([
            'owner_id' => 3,
            'name' => '音楽',
            'comment' => '色んな音楽をみんなでシェアしよ!',
        ]);

        DB::table('rooms')->insert([
            'owner_id' => 4,
            'name' => 'ダンス',
            'comment' => '踊ろうぜ!!',
        ]);
    }
}
