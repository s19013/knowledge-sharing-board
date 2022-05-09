@extends('layouts.app')

@section('js')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/myRoom.css') }}">
@endsection
@section('content')
<div class="container">
    <form action="{{route('searchRoom')}}" method="get">
        @csrf
        <input type="text" name="searchName" required>
        <input type="submit" class="btn btn-primary" value="探す">
    </form>
    @foreach ($rooms as $room)
        <div>
            <p>{{$room['name']}}</p>
            <p>{{$room['owner']}}</p>
        </div>
    @endforeach
</div>
@endsection
