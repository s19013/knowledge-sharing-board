<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="/js/slide.js"></script>{{-- 余りよい方法では無いが他に手段がないので今はこれで  --}}
    @yield('js')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/slideMenu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <button class="LeftSlideMenuBtn m-1" id="LeftSlideMenuBtn">メニュー</button>
            <div class="LeftSlideMenu">
                <nav id="LeftSlideMenuNav">
                    <ul class="p-0">
                      <li><a href="#">ホーム</a></li>
                      <li><a href="#">サービス概要</a></li>
                      <li><a href="#">実績紹介</a></li>
                      <li><a href="#">お問い合わせ</a></li>
                    </ul>
                    <button class="d-flex align-items-end mx-auto">部屋を作る</button>
                </nav>
            </div>

        <p class="text-center m-2 roomName">{{$roomName}}</p>

        <div class="myRoomIconContena" id="RightSlideMenuBtn" >
            <button>
                @if (empty($imgUrl))
                {{-- dummy_profile --}}
                    <img class="myRoomIcon p-0" src="{{ asset('img/dummy_profile.png') }}">
                @else
                    <img class="myRoomIcon p-0"  src="{{ asset("img/<?= "$imgUrl" ?>") }}">{{-- かなり強引な書き方になった --}}
                @endif
            </button>
        </div>
            <div class="RightSlideMenu">
                <nav id="RightSlideMenuNav">
                    <ul class="p-0">
                        <li><a href="/myRoom">マイルーム</a></li>
                        <li>
                            <a class="dropdown-item p-0" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                 @csrf
                            </form>
                        </li>
                    </ul>
                    <button class="d-flex align-items-end mx-auto">部屋を作る</button>
                </nav>
            </div>

    </header>
    <div id="app">
        <main class="py-4">
            <div id="loading">
                <div class="spinner"></div>
            </div>
            @yield('content')
        </main>
    </div>
</body>
<script src="{{ asset('js/loading.js') }}"></script>{{-- ここに書かないとバグる? --}}
</html>
