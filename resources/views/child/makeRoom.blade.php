@extends('layouts.app')

@section('js')
@endsection

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('css/myRoom.css') }}"> --}}
@endsection
@section('content')
<div class="container">
    <form action="{{route('makeRoom')}}" method="POST">
        {{-- 名前,公開非公開 --}}
        {{-- makeRoomの関数へ --}}
        {{-- roomNameは必ず埋める --}}
        @csrf
        <input type="text" name="roomName" required>
        <input type="submit" value="作成" class="submitBtn">
    </form>
</div>
@endsection
