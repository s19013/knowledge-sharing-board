<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Room extends Model
{
    use HasFactory;
    protected function addRoomToDB($posts,$userId)
    {
        return DB::transaction(function() use($posts,$userId){
            // roomDBにデータを登録.
            $roomId = Room::insertGetId(['owner_id' => $userId,'name' => $posts['roomName'],'public'=>1,'comment' => $posts['comment']]);
            return $roomId;
        });
    }

    protected function isRoomPublic($roomId)
    {
        $public = Room::select('public')
                ->where('id','=',$roomId)
                ->WhereNull('deleted_at')
                ->first();
        if ($public['public'] == 1) {return true;}
        else {return false;}
    }

    protected function getRoomName($roomId)
    {
        $roomName = Room::select('name')
                ->where('id','=',$roomId)
                ->first();
        return $roomName['name'];
    }

    protected function getRooms($searchName)
    {
        $serchQuery = Room::query()
                ->select('users.name AS ownerName','rooms.name AS roomName','rooms.id as room_id','rooms.comment as comment','rooms.created_at')
                ->orderby('rooms.created_at','desc')
                ->join('users','users.id','=','rooms.owner_id');

        if (!empty($searchName)) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($searchName, 's');

            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $serchQuery->where('rooms.name', 'like', '%'.$value.'%');
            }
        }
        return $serchQuery->paginate(10);
    }
}
