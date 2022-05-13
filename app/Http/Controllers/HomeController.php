<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        $rooms = findRoomsUserBelongto(\Auth::id());
        $this->imgUrl= getImgUrl(\Auth::id());
        return view('child/myRoom',compact('rooms'))
        ->with('roomName','マイルーム')
        ->with('imgUrl',$this->imgUrl);
    }

    public function transitionToMakeRoom()
    {
        return view('child/makeRoom')
        ->with('roomName','部屋作成');
    }

    public function makeRoom(Request $request)
    {
        $posts=$request->all();
        $roomId = '';

        $roomId = DB::transaction(function() use($posts){
            // roomDBにデータを登録.
            $roomId = Room::insertGetId(['owner_id' => \Auth::id(),'name' => $posts['roomName'],'public'=>1,'comment' => $posts['comment']]);
            return $roomId;
        });

        //ユーザーを作った部屋のメンバーに加える
        joinMember(\Auth::id(),$roomId);
        // 二重送信防止
        $request->session()->regenerateToken();

        return redirect()->route('transitionToRoom', ['roomId' => $roomId]);
    }

    public function transitionToRoom()
    {
        $roomId =\Request::query('roomId');
        $roomName = getRoomsName($roomId);
        $linkCards = getLinkCards($roomId);

        // メンバーかどうか確かめる
        if (checkIsHeMember(\Auth::id(),$roomId)) {return view('child/room',compact('roomName','roomId','linkCards'));}
        else {
            //公開かどうか確かめる
            if (isRoomPublic($roomId)) {
                //メンバーに加える
                joinMember(\Auth::id(),$roomId);
                return view('child/room',compact('roomName','roomId','linkCards'));
            } else {
                // 弾く
                return view('child/room')
                ->with('roomName','マイルーム');
            }
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
        ->select('users.name AS ownerName','rooms.name AS roomName','rooms.id as room_id','rooms.comment as comment')
        ->join('rooms','users.id','=','rooms.owner_id');

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

        $rooms = $serchQuery->paginate(10);

        return view('child/searchRoom',compact('roomName','rooms'));
    }

    public function transitionToWithdrawal()
    {
        return view('child/withdrawal')
        ->with('roomName','退会');
    }

    public function withdrawal()
    {
        // 論理削除
        $user = User::find(Auth::id());
        $user->delete();
        Auth::logout();
        return redirect(route('login'));
    }

}

function joinMember($userId,$roomId)
{
    DB::transaction(function () use($roomId,$userId){
        RoomMember::insert(['room_id' => $roomId,'member_id' => $userId]);
    });

}

function getLinkCards($roomId)
{
    return LinkCard::select('title','comment','url')
            ->where('room_id','=',$roomId)
            ->paginate(100);
}

function isRoomPublic($roomId)
{
    $public = Room::select('public')
            ->where('id','=',$roomId)
            ->WhereNull('deleted_at')
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

function findRoomsUserBelongto($userId){
    return RoomMember::select('room_id','rooms.name as roomName','users.name as ownerName')
        ->join('rooms','rooms.id','=','room_id')
        ->join('users','users.id','=','rooms.owner_id')
        ->Where('member_id','=',$userId)
        ->WhereNull('rooms.deleted_at')
        ->paginate(5);
}

function getImgUrl($userId){
    $imgUrl = User::select('imgUrl')
            ->where('id','=',$userId)
            ->first();
    return  $imgUrl['imgUrl'];
}
