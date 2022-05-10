@extends('layouts.app')

@section('js')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/myRoom.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="userInfBox">
        @if (empty($userInf['imgUrl']))
            <img class="profileImg" src="{{ asset('img/dummy_profile.png') }}" alt="">
        @endif
        <p class="m-0 fs-2">{{ Auth::user()->name }}</p>
    </div>

    <div class="ButtonsContena row justify-content-between">
        <button type="button" class="makeRoomBtn btn btn-primary col-3" onclick="location.href='{{route('transitionToMakeRoom')}}'">部屋を作る</button>
        <button type="button" class="searchRoomBtn btn btn-primary col-3" onclick="location.href='{{route('searchRoom')}}'">部屋を探す</button>
    </div>

    <h3>所属している部屋</h3>
    {{-- ここ孫bladeとかでまとめられないかな? --}}
    <div class="roomContainer border border-dark">
        @foreach ($roomsUserBelongTo as $room)
            <div class="room m-1 border border-dark">
                <div class="Card border-end border-dark m-0">
                    <div class="cardHeader fs-4 font-weight-bold">
                        <p class="name m-0">{{$room['roomName']}}</p>
                    </div>
                    <div class="cardBody">
                        <p class="owner border-bottom m-0">{{$room['ownerName']}}</p>
                        <p class="comment m-0">コメント</p>
                    </div>
                </div>
                <button onclick="location.href='/room/{{$room['room_id']}}'">部屋に入る</button>
            </div>
        @endforeach
    </div>
    {{-- @foreach ($roomsUserBelongTo as $rooms)
    <div class="roomsContena">
        <p>{{$rooms['name']}}</p>
        <button onclick="location.href='/room/{{$rooms['room_id']}}'">部屋に入る</button>
    </div>

    @endforeach --}}
</div>
@endsection
