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

}
