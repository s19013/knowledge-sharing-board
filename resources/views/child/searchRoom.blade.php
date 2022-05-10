@extends('layouts.app')

@section('js')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/searchRoom.css') }}">
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
                        <p class="name m-0">{{$room['name']}}</p>
                    </div>
                    <div class="cardBody">
                        <p class="owner border-bottom m-0">{{$room['owner']}}</p>
                        <p class="comment m-0">コメント</p>
                    </div>
                </div>
                <button onclick="location.href='/room/{{$room['room_id']}}'">部屋に入る</button>
            </div>
        @endforeach
    </div>
</div>
@endsection
