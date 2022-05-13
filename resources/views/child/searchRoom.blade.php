@extends('layouts.app')

@section('js')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/searchRoom.css') }}">
<link rel="stylesheet" href="{{ asset('css/roomContainer.css') }}">
@endsection
@section('content')
<div class="container">
    <form action="{{route('searchRoom')}}" method="get">
        @csrf
        <input type="text" name="searchName" class="searchName" minlength='2' maxlength='100' required>
        <input type="submit" class="btn btn-primary" value="探す">
    </form>
    <div class="roomContainer border border-dark">
        @foreach ($rooms as $room)
            <div class="room m-1 border border-dark">
                <div class="Card border-end border-dark m-0">
                    <div class="cardHeader fs-4 font-weight-bold">
                        <p class="name m-0">{{$room['roomName']}}</p>
                    </div>
                    <div class="cardBody">
                        <p class="owner border-bottom m-0">部屋主:{{$room['ownerName']}}</p>
                        <p class="comment m-0">コメント</p>
                    </div>
                </div>
                <a href="/room?roomId={{$room['room_id']}}&page=1"><button>部屋に入る</button></a>
            </div>
        @endforeach
    </div>
    <footer >
        {{$rooms->appends(['searchName'=> \Request::query('searchName')])->links()}}
    </footer>
</div>
@endsection
