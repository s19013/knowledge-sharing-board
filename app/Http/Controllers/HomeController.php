<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkCard;
use App\Models\Room;
use App\Models\RoomMember;
use App\Models\User;
use DB;

class HomeController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function myRoom(){
        $roomsUserBelongTo = findGroupsUserBelongto();
        $imgUrl= getImgUrl(\Auth::id());
        $roomName = 'MY ROOM';
        return view('child/myRoom',compact('imgUrl','roomName','roomsUserBelongTo'));
    }

    public function makeRoom(Request $request)
    {
        // 送られた値を受け取る
        // roomDBにデータを登録
        // roomMemberにもデータを登録
        // 作った画面に遷移 リンクカードを見せる画面とか
        $posts=$request->all();
        $roomName = '';

        DB::transaction(function() use($posts){
            // roomDBにデータを登録.
            $roomId = Room::insertGetId(['owner_id' => \Auth::id(),'name' => $posts['roomName'],'public'=>1]);
            RoomMember::insert(['room_id' => $roomId,'member_id' => \Auth::id(),]);

        });
        // 実際に画面に移動するがいまはテスト
        return view('child/myRoom',compact('roomName'));
    }

    public function transitionToMakeRoom()
    {
        $roomName = '部屋作成';
        return view('child/makeRoom',compact('roomName'));
    }

}

function findGroupsUserBelongto(){
        return RoomMember::select('room_id','name')
        ->join('rooms','rooms.id','=','room_id')
        ->Where('member_id','=',\Auth::id())
        ->WhereNull('rooms.deleted_at')
        ->get();
}

function getImgUrl($id){
    $imgUrl = User::select('imgUrl')
        ->where('id','=',$id)
        ->first();
    return  $imgUrl['imgUrl'];
}
