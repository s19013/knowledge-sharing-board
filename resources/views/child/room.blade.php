{{--
    使える変数
    $roomID
    $linkCards
--}}
@extends('layouts.app')

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('css/myRoom.css') }}"> --}}
@endsection

@section('content')
<div class="container">
    <form action="{{route('transitionToMakeLinkCard')}}" method="POST">
        @csrf
        <input type="hidden" name="roomId" value='{{$roomId}}'>
        <input type="submit" value="リンクカード作成" class="btn btn-primary">
    </form>
    <div class="bord">
        @foreach ($linkCards as $card)
        <a href="{{$card['url']}}">
            <div class="card">
                <h5 class="card-header">{{$card['title']}}</h5>
                <div class="card-body">
                    <p>{{$card['comment']}}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
