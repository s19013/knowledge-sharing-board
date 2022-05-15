@extends('layouts.app')

@section('js')
<script>
window.addEventListener('load', function(){
    const $input = document.getElementById('titleInput');
    const $wordCount = document.getElementById('titleWordCount')
    $input.addEventListener('keyup', function () {
        $wordCount.textContent = `残り${90 - $input.value.length}文字`;
    })
});
window.addEventListener('load', function(){
    const $input=document.getElementById('commentInput');
    const $wordCount = document.getElementById('commentWordCount')
    $input.addEventListener('keyup', function () {
        $wordCount.textContent = `残り${180 - $input.value.length}文字`;
    })
});
</script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/makeLinkCard.css') }}">
@endsection

@section('content')
<div class="container">
    <form action="{{route('makeLinkCard')}}" method="POST">
        @csrf
        <input type="hidden" name="roomId" value="{{$roomId}}">
        <div class='formBlock'>
            <h2>タイトル <span class="fs-6 text-danger">[必須]</span></h2>
            <input id="titleInput" class="w-100" type="text" name="title" minlength='2' maxlength='90' required autofocus>
            <p class="counter" id="titleWordCount">残り90文字</p>
        </div>
        <div class="formBlock">
            <h2>URL <span class="fs-6 text-danger">[必須]</span></h2>
            <input type="text" name="url" class="w-100" minlength='10' required autofocus>
        </div>
        <div class="formBlock">
            <h2>コメント</h2>
            <textarea name="comment" id="commentInput" class="w-100" rows="2" maxlength='180' autofocus></textarea>
            <p class="counter" id="commentWordCount">残り180文字</p>
        </div>
        <input type="submit" value="作成" class="submitBtn">
    </form>
</div>
@endsection
