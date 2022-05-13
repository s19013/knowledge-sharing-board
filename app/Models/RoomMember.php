<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class RoomMember extends Model
{
    use HasFactory;

    protected function joinMember($userId,$roomId)
    {
        DB::transaction(function () use($roomId,$userId){
            RoomMember::insert(['room_id' => $roomId,'member_id' => $userId]);
        });
    }

    protected function isHeMember($userId,$roomId)
    {
        return RoomMember::where('member_id','=',$userId)
                ->where('room_id','=',$roomId)
                ->exists();//メンバーならtrue
    }

    protected function findRoomsUserBelongTo($userId)
    {
        return RoomMember::select('room_id','rooms.name as roomName','users.name as ownerName')
            ->join('rooms','rooms.id','=','room_id')
            ->join('users','users.id','=','rooms.owner_id')
            ->Where('member_id','=',$userId)
            ->WhereNull('rooms.deleted_at')
            ->paginate(5);
    }
}
