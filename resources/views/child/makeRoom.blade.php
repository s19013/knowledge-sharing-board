@extends('layouts.app')

@section('js')
@endsection

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('css/myRoom.css') }}"> --}}
@endsection
@section('content')
<div class="container">
    <form action="{{route('makeRoom')}}" method="POST">
        @csrf
        <input type="text" name="roomName" minlength='2' maxlength='50' required>
        {{-- <input type="text" name="comment" maxlength='100' required> --}}
        {{-- 公開非公開のラジオボタン --}}
        <input type="submit" value="作成" class="submitBtn">
    </form>
</div>
@endsection
