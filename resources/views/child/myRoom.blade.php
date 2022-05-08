@extends('layouts.app')

@section('content')
<div class="container">
    <div class="userInfBox">
        @if (empty($userInf['imgUrl']))
            <img class="profileImg" src="{{ asset('img/dummy_profile.png') }}" alt="">
        @endif
        <p class="m-0 fs-2">{{ Auth::user()->name }}</p>
    </div>

    <div class="ButtonsContena row justify-content-between">
        <button type="button" class="makeRoomBtn btn btn-primary col-3">部屋を作る</button>
        <button type="button" class="searchRoomBtn btn btn-primary col-3" onclick="location.href='./index.html'">部屋を探す</button>
    </div>
</div>
@endsection
