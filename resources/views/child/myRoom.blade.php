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
        <button type="button" class="makeRoomBtn btn btn-primary col-3" onclick="location.href='{{route('transitionToMakeRoom')}}'">部屋を作る</button>
        <button type="button" class="searchRoomBtn btn btn-primary col-3" onclick="location.href=''">部屋を探す</button>
    </div>

    @foreach ($roomsUserBelongTo as $rooms)
            <p>{{$rooms['name']}}</p>
    @endforeach
</div>
@endsection
