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

        // グローバル変数とかでデータを一時保存とかしたほうがいい気がする
        $this->imgUrl = null;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function myRoom(){
        $roomsUserBelongTo = findGroupsUserBelongto();
        $this->imgUrl= getImgUrl(\Auth::id());
        $roomName = 'MY ROOM';
        return view('child/myRoom',compact('roomName','roomsUserBelongTo'))
        ->with('imgUrl',$this->imgUrl);
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
        // 二重送信防止になるらしい
        $request->session()->regenerateToken();
        // 実際に画面に移動する
        return redirect()->route('transitionToRoom', ['roomId' => $posts['roomId']]);
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
        // 二重送信防止になるらしい
        $request->session()->regenerateToken();

        //リダイレクトをすればリロードしても二重登録されないし419エラーもでない!
        return redirect()->route('transitionToRoom', ['roomId' => $posts['roomId']]);
    }

    public function searchRoom()
    {
        $roomName = '部屋を探す';
        $searchName =\Request::query('searchName');
        $serchQuery = User::query()
        ->select('users.name AS ownerName','rooms.name AS roomName','rooms.id as room_id')
        ->join('rooms','users.id','=','rooms.owner_id')
        ->limit(100);

        if (!empty($searchName)) {
            //借りてきたもの
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($searchName, 's');

            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            // 単語をループで回し、ユーザーネームと部分一致するものがあれば、$queryとして保持される
            foreach($wordArraySearched as $value) {
                $serchQuery->where('rooms.name', 'like', '%'.$value.'%');
            }
        }

        $rooms = $serchQuery->get();

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
        return RoomMember::select('room_id','rooms.name as roomName','users.name as ownerName')
        ->join('rooms','rooms.id','=','room_id')
        ->join('users','users.id','=','rooms.owner_id')
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
