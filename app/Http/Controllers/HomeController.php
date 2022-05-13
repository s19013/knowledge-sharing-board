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

        $this->userModel = new User;
        $this->roomModel = new Room;
        $this->roomMemberModel = new RoomMember;
        $this->linkCardModel = new LinkCard;

        // グローバル変数とかでデータを一時保存とかしたほうがいい気がする
        $this->imgUrl = null;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function myRoom(){
        $rooms = $this->roomMemberModel->findRoomsUserBelongto(\Auth::id());
        $this->imgUrl= $this->userModel->getImgUrl(\Auth::id());

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

        // 受け取ったデータをdbに登録してその部屋のIDを受け取る
        $roomId = $this->roomModel->addRoomToDB($posts,\Auth::id());

        //ユーザーを作った部屋のメンバーに加える
        $this->roomMemberModel->joinMember(\Auth::id(),$roomId);

        // 二重送信防止
        $request->session()->regenerateToken();

        return redirect()->route('transitionToRoom', ['roomId' => $roomId]);
    }

    public function transitionToRoom()
    {
        $roomId =\Request::query('roomId');
        $roomName = $this->roomModel->getRoomName($roomId);
        $linkCards = $this->linkCardModel->getLinkCards($roomId);

        // メンバーかどうか確かめる
        if ($this->roomMemberModel->isHeMember(\Auth::id(),$roomId)) {return view('child/room',compact('roomName','roomId','linkCards'));}
        else {
            //公開かどうか確かめる
            if ($this->roomModel->isRoomPublic($roomId)) {
                //メンバーに加える
                $this->roomMemberModel->joinMember(\Auth::id(),$roomId);
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

        return view('child/makeLinkCard',compact('roomName','roomId'))
        ->with('roomName','リンクカード作成')
        ;
    }

    public function makeLinkCard(Request $request)
    {
        $posts=$request->all();
        $this->linkCardModel->addCardToDB($posts);
        // 二重送信防止になるらしい
        $request->session()->regenerateToken();

        //リダイレクトをすればリロードしても二重登録されないし419エラーもでない!
        return redirect()->route('transitionToRoom', ['roomId' => $posts['roomId']]);
    }

    public function searchRoom()
    {
        $searchName =\Request::query('searchName');
        $rooms = $this->roomModel->getRooms($searchName);

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
        $this->userModel->deleteUser(Auth::id());
        Auth::logout();
        return redirect(route('login'));
    }

}
