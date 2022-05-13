<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class LinkCard extends Model
{
    use HasFactory;

    protected function addCardToDB($posts)
    {
        DB::transaction(function() use($posts){
            // roomDBにデータを登録.
            LinkCard::insert(['user_id' => \Auth::id(),
            'room_id' => $posts['roomId'],
            'title'=>$posts['title'],
            'comment'=>$posts['comment'],
            'url'=>$posts['url']]);
        });
    }

    protected function getLinkCards($roomId)
    {
        return LinkCard::select('title','comment','url')
        ->where('room_id','=',$roomId)
        ->paginate(100);
    }
}
