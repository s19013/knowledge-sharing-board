@extends('layouts.app')
@section('css')
{{-- <link rel="stylesheet" href="{{ asset('css/myRoom.css') }}"> --}}
@endsection
@section('content')
<div class="container">
    <form action="{{route('makeLinkCard')}}" method="POST">
        @csrf
        <input type="hidden" name="roomId" value="{{$roomId}}">
        <input type="text" name="title" required>
        <input type="text" name="url" required>
        <input type="text" name="comment">
        <input type="submit" value="作成" class="submitBtn">
    </form>
</div>
@endsection
