<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use DB;

class LinkCardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'Poolside Remix',
            'comment' => '一番好き!!水系トランス最高!!',
            'url' => 'https://youtu.be/mPgJzeDnsrQ',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'fly above',
            'comment' => 'sota製トランス最高!!',
            'url' => 'https://youtu.be/wnbHXTFbsYU',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'lift us high',
            'comment' => 'sota製トランスに外れなし!',
            'url' => 'https://youtu.be/dbaLRcGXlUo',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'Infinity Mirror',
            'comment' => 'Dirty Androidsとか言ってるけど作る曲はcleanだったり､beautyだったり',
            'url' => 'https://youtu.be/X5i1ZlV_mnw',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'all i need your love',
            'comment' => '',
            'url' => 'https://youtu.be/q9inaj9R7d0',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'fire strike',
            'comment' => '',
            'url' => 'https://youtu.be/EG-9Fxkw42Q',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'my time',
            'comment' => 'hardStyle',
            'url' => 'https://youtu.be/-rGXlLCHF1Q',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'まりか8',
            'comment' => '',
            'url' => 'https://youtu.be/E2U5GoX4dew',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'Arcana',
            'comment' => '',
            'url' => 'https://youtu.be/clw9gh1pGYA',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'SOUQ - Final Round',
            'comment' => '鉄拳7 A Grain of Sand',
            'url' => 'https://youtu.be/bLeK3QAkCbg',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => "Dragon's Nest ",
            'comment' => '',
            'url' => 'https://youtu.be/aRBncKkYQDk',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 3,
            'room_id' => 3,
            'title' => 'ugh',
            'comment' => '',
            'url' => 'https://youtu.be/1rRwCOIGYaA',
        ]);

        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => 'Sugar - Maroon 5',
            'comment' => '',
            'url' => 'https://youtu.be/SDAL5VCdKpc',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => 'はんくら',
            'comment' => '',
            'url' => 'https://youtu.be/QzkBbycSSuo',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => 'party rock',
            'comment' => '',
            'url' => 'https://youtu.be/ZzgsPHee8No',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => 'party rock',
            'comment' => '',
            'url' => 'https://youtu.be/fvmuRtEw80s',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => 'セーラームーン',
            'comment' => '変身の再現シーンが見どころ',
            'url' => 'https://youtu.be/deT-IqN0Zp8',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => 'ランニングマン',
            'comment' => '',
            'url' => 'https://youtu.be/FR1Wi5YM5Ww',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => ' Deep Mentality (Lotus Juice Remix)',
            'comment' => '',
            'url' => 'https://youtu.be/00C7rJyWH7g',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => ' Rivers In the Desert',
            'comment' => '',
            'url' => 'https://youtu.be/u-8BMrEpqqM',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => ' Want To Be Close (ATOLS Remix)',
            'comment' => '',
            'url' => 'https://youtu.be/2LrsxflGLik',
        ]);
        DB::table('link_cards')->insert([
            'user_id' => 4,
            'room_id' => 4,
            'title' => ' luv can',
            'comment' => '',
            'url' => 'https://youtu.be/12nAIGX2rQE',
        ]);
    }
}
