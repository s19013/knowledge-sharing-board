@extends('layouts.app')

@section('js')
@endsection
<script>
    window.addEventListener('load', function(){
    document.getElementById('titleInput').addEventListener('keyup', function () {
        document.getElementById('titleWordCount').textContent = `残り${90 - document.getElementById('titleInput').value.length}文字`;
    })

    document.getElementById('commentInput').addEventListener('keyup', function () {
        document.getElementById('commentWordCount').textContent = `残り${180 - document.getElementById('commentInput').value.length}文字`;
    })
});
</script>
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
            <input id="titleInput" class="w-100" type="text" name="title" minlength='2' maxlength='90' required >
            <p class="counter" id="titleWordCount">残り90文字</p>
        </div>
        <div class="formBlock">
            <h2>URL <span class="fs-6 text-danger">[必須]</span></h2>
            <input type="text" name="url" class="w-100" required>
        </div>
        <div class="formBlock">
            <h2>コメント</h2>
            <textarea name="comment" id="commentInput" cols="90" rows="2" maxlength='180'></textarea>
            <p class="counter" id="commentWordCount">残り180文字</p>
        </div>
        <input type="submit" value="作成" class="submitBtn">
    </form>
</div>
@endsection
