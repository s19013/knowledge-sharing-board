@extends('layouts.app')

@section('js')
<script>
    window.addEventListener('load', function(){
        const $input=document.getElementById('roomNameInput');
        const $wordCount = document.getElementById('roomNameWordCount');
        $input.addEventListener('keyup', function () {
            $wordCount.textContent = `残り${50 - $input.value.length}文字`;
        })
    });
    </script>
@endsection
@section('css')
{{-- <link rel="stylesheet" href="{{ asset('css/myRoom.css') }}"> --}}
@endsection
@section('content')
<div class="container">
    <form action="{{route('makeRoom')}}" method="POST">
        <div class='formBlock'>
            @csrf
            <h2>部屋の名前 <span class="fs-6 text-danger">[必須]</span></h2>
            <input type="text" id="roomNameInput" class="w-100 mt-2" name="roomName" placeholder="例: 〇〇の勉強方法" minlength='2' maxlength='50' required>
            <p class="counter" id="roomNameWordCount">残り50文字</p>
            {{-- <input type="text" name="comment" maxlength='100' required> --}}
            {{-- 公開非公開のラジオボタン --}}
            <input type="submit" value="作成" class="submitBtn">
        </div>
    </form>
</div>
@endsection
