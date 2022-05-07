<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinkCard;
use App\Models\Room;
use App\Models\RoomMember;
use App\Models\User;

class HomeController extends Controller
{
    // imgUrlはAppServieceProvide.phpで取っている

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
        return view('child/myRoom');
    }
}
