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
            RoomMember::insert(['room_id' => $roomId,'member_id' => \Auth::id()]);

        });
        // 実際に画面に移動する
        return $this->transitionToRoom();
    }

    public function transitionToMakeRoom()
    {
        $roomName = '部屋作成';
        return view('child/makeRoom',compact('roomName'));
    }


    public function transitionToRoom($roomId)
    {
        // メンバーかどうか確かめる
        if (checkIsHeMember(\Auth::id(),$roomId)) {
            $linkCards = LinkCard::select('title','comment','url')
            ->where('room_id','=',$roomId)
            ->get();
            $roomName = getRoomsName($roomId);
            return view('child/room',compact('roomName','roomId','linkCards'));
        } else {
            $this->myRoom();
        }
    }

    public function transitionToMakeLinkCard(Request $request)
    {
        $posts=$request->all();
        $roomId=$posts['roomId'];
        $roomName ='リンクカード作成';
        return view('child/makeLinkCard',compact('roomName','roomId'));
    }

    public function makeLinkCard(Request $request)
    {
        $posts=$request->all();
        DB::transaction(function() use($posts){
            // roomDBにデータを登録.
            LinkCard::insert(['user_id' => \Auth::id(),
            'room_id' => $posts['roomId'],
            'title'=>$posts['title'],
            'comment'=>$posts['comment'],
            'url'=>$posts['url']]);
        });

        return $this->transitionToRoom($posts['roomId']);
    }
}

function getRoomsName($roomId)
{
    $roomName = Room::select('name')
            ->where('id','=',$roomId)
            ->first();
    return $roomName['name'];
}

function checkIsHeMember($userId,$roomId)
{
    return RoomMember::where('member_id','=',$userId)
            ->where('room_id','=',$roomId)
            ->exists();//メンバーならtrue
}

function findGroupsUserBelongto(){
        return RoomMember::select('room_id','name')
        ->join('rooms','rooms.id','=','room_id')
        ->Where('member_id','=',\Auth::id())
        ->WhereNull('rooms.deleted_at')
        ->get();
}

function getImgUrl($userId){
    $imgUrl = User::select('imgUrl')
            ->where('id','=',$userId)
            ->first();
    return  $imgUrl['imgUrl'];
}
