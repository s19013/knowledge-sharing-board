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
        $this->User = new User;
        $this->Room = new Room;
        $this->RoomMember = new RoomMember;
        $this->LinkCard = new LinkCard;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function myRoom(){
        $rooms = $this->RoomMember->findRoomsUserBelongto(\Auth::id());
        $this->imgUrl= $this->User->getImgUrl(\Auth::id());
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

        // 受け取ったデータをdbに登録してその部屋のIDを受け取る
        $roomId = $this->Room->addRoomToDB($posts,\Auth::id());

        //ユーザーを作った部屋のメンバーに加える
        $this->RoomMember->joinMember(\Auth::id(),$roomId);
        // 二重送信防止
        $request->session()->regenerateToken();

        return redirect()->route('transitionToRoom', ['roomId' => $roomId]);
    }

    public function transitionToRoom()
    {
        $roomId =\Request::query('roomId');
        $roomName = $this->Room->getRoomName($roomId);
        $linkCards = $this->LinkCard->getLinkCards($roomId);

        // メンバーかどうか確かめる
        if ($this->RoomMember->isHeMember(\Auth::id(),$roomId)) {return view('child/room',compact('roomName','roomId','linkCards'));}
        else {
            //公開かどうか確かめる
            if ($this->Room->isRoomPublic($roomId)) {
                //メンバーに加える
                $this->RoomMember->joinMember(\Auth::id(),$roomId);
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
        $this->LinkCard->addCardToDB($posts);
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
        $this->User->deleteUser(Auth::id());
        Auth::logout();
        return redirect(route('login'));
    }

}
