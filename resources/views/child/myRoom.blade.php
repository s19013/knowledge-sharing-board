@extends('layouts.app')

@section('js')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/myRoom.css') }}">
<link rel="stylesheet" href="{{ asset('css/roomContainer.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="userInfBox">
        @if (empty($userInf['imgUrl']))
            <img class="profileImg" src="{{ asset('img/dummy_profile.png') }}" alt="">
        @endif
        <p class="m-0">{{ Auth::user()->name }}</p>
    </div>

    <h3>所属している部屋</h3>
    {{-- ここ孫bladeとかでまとめられないかな? --}}
    <div class="roomContainer border border-dark">
        @foreach ($rooms as $room)
            <div class="room m-1 border border-dark">
                <div class="Card border-end border-dark m-0">
                    <div class="cardHeader fs-4 font-weight-bold">
                        <p class="name m-0">{{$room['roomName']}}</p>
                    </div>
                    <div class="cardBody">
                        <p class="owner border-bottom m-0">部屋主:{{$room['ownerName']}}</p>
                        <p class="comment m-0">{{$room['comment']}}</p>
                    </div>
                </div>
                <a href="/room?roomId={{$room['room_id']}}&page=1"><button>部屋に入る</button></a>
            </div>
        @endforeach
    </div>
    <footer>
        {{$rooms->links()}}
    </footer>
</div>
@endsection
