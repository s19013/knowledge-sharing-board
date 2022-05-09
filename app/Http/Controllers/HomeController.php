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

    public function transitionToMakeRoom()
    {
        $roomName = '部屋作成';
        return view('child/makeRoom',compact('roomName'));
    }

    public function makeRoom(Request $request)
    {
        $posts=$request->all();
        $roomId = '';

        $roomId = DB::transaction(function() use($posts){
            // roomDBにデータを登録.
            $roomId = Room::insertGetId(['owner_id' => \Auth::id(),'name' => $posts['roomName'],'public'=>1]);
            RoomMember::insert(['room_id' => $roomId,'member_id' => \Auth::id()]);
            return $roomId;

        });
        // 実際に画面に移動する
        return $this->transitionToRoom($roomId);
    }

    public function transitionToRoom($roomId)
    {
        $roomName = getRoomsName($roomId);
        $linkCards = getLinkCards($roomId);
        //公開かどうか確かめる
        if (isRoomPublic($roomId)) {return view('child/room',compact('roomName','roomId','linkCards'));}
        else {
            // メンバーかどうか確かめる
            if (checkIsHeMember(\Auth::id(),$roomId)) {return view('child/room',compact('roomName','roomId','linkCards'));}
            else {return $this->myRoom();}
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

    public function transitionToSerachRoom()
    {
        $roomName = '部屋を探す';
        // 部屋を100件とってくる
        $rooms = User::select('users.name AS owner','rooms.name AS name')//コメントも追加
        ->join('rooms','users.id','=','rooms.owner_id')
        ->limit(100)
        ->get();


        return view('child/searchRoom',compact('roomName','rooms'));
    }
}
function getLinkCards($roomId)
{
    return LinkCard::select('title','comment','url')
            ->where('room_id','=',$roomId)
            ->get();
}

function isRoomPublic($roomId)
{
    $public = Room::select('public')
            ->where('id','=',$roomId)
            ->first();
    if ($public['public'] == 1) {return true;}
    else {return false;}
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
