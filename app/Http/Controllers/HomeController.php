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
        $this->imgUrl= User::getImgUrl(Auth::id());
        $rooms = RoomMember::findRoomsUserBelongTo(Auth::id());

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
        $posts  = $request->all();

        // 受け取ったデータをdbに登録してその部屋のIDを受け取る
        $roomId = Room::addRoomToDB($posts,Auth::id());

        //ユーザーを作った部屋のメンバーに加える
        RoomMember::joinMember(Auth::id(),$roomId);

        // 二重送信防止
        $request->session()->regenerateToken();

        return redirect()->route('transitionToRoom', ['roomId' => $roomId]);
    }

    public function transitionToRoom()
    {
        $roomId    = \Request::query('roomId');
        $roomName  = Room::getRoomName($roomId);
        $linkCards = LinkCard::getLinkCards($roomId);

        // メンバーかどうか確かめる
        if (RoomMember::isHeMember(Auth::id(),$roomId)) {return view('child/room',compact('roomName','roomId','linkCards'));}
        else {
            //公開かどうか確かめる
            if (Room::isRoomPublic($roomId)) {
                //メンバーに加える
                RoomMember::joinMember(Auth::id(),$roomId);
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
        $posts  = $request->all();
        $roomId = $posts['roomId'];

        return view('child/makeLinkCard',compact('roomId'))
        ->with('roomName','リンクカード作成')
        ;
    }

    public function makeLinkCard(Request $request)
    {
        $posts=$request->all();
        LinkCardModel::addCardToDB($posts);
        // 二重送信防止になるらしい
        $request->session()->regenerateToken();

        //リダイレクトをすればリロードしても二重登録されないし419エラーもでない!
        return redirect()->route('transitionToRoom', ['roomId' => $posts['roomId']]);
    }

    public function searchRoom()
    {
        $searchName = \Request::query('searchName');
        $rooms      = Room::getRooms($searchName);

        return view('child/searchRoom',compact('rooms'))
        ->with('roomName','部屋を探す');
    }

    public function transitionToWithdrawal()
    {
        return view('child/withdrawal')
        ->with('roomName','退会');
    }

    public function withdrawal()
    {
        // 論理削除
        User::deleteUser(Auth::id());
        Auth::logout();
        return redirect(route('login'));
    }

}
