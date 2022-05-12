@extends('layouts.app')

@section('js')

@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/room.css') }}">
@endsection

@section('content')
<div class="container">
    <form action="{{route('transitionToMakeLinkCard')}}" method="POST">
        @csrf
        <input type="hidden" name="roomId" value='{{$roomId}}'>
        <input type="submit" value="リンクカード作成" class="btn btn-primary mb-2">
    </form>
    <div class="bord border border-dark">
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
    <footer class="mt-2">
        {{$linkCards->appends(['roomId'=> $roomId])->links()}}
    </footer>
</div>
@endsection
