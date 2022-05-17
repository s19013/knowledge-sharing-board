<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Knowledge Sharing Board

## 概要
記事や動画のurlをみんなでシェアする

## 使い方

## 使った技術
* php
* laravel 
* bootstrap5
* html5
* css3
* scss
* node.js
* javaScript
* aws lightsail
* ubuntu 
* apache 
* mariaDB

## 制作背景
twitterでURLだけをシェアしあいたいというツイートを見かけたから作ってみようと思ったから

## 実装した大まかな機能
* ユーザー登録
* ログイン
* ログアウト
* 退会
* マイルーム
* 部屋作成
* 部屋検索
* カード作成

## 苦労したところ
* paginationの標準する数を変更するために､ファイルと変数などを探したこと
* リロードによる二重登録防止
* lightSailの標準lampセットは古いバージョンだったので結局自分でlamp環境を作らないといかなかったところ
* デプロイ作業
* サイトの大きさや余白の調整

## 反省
* 今思えばサービスの名前が不適切[Link-Sharing-Board]のほうが適切な名前だと思う｡
* かなり進んだところで[そういえばコミットしてない!]という状態になった
* 出たばかりの最新バージョンではなく1つ前のバージョンでやったほうが情報が沢山あるので､別の対応をしなくて楽だったかもしれない
* lightSailで使えるphpのバージョンを確認してから制作すればもっと楽だったと思う
->apacheをインストールしたりする練習にはなった

## 正直なところ理解が曖昧なところ
* 退会処理
* ページネイション
* リダイレクト
* append
* laravelのもっと細かいところ
* window.addEventListener('load', function(){});
* リファクタリング
* ログインのバリデーション
* apache関連
* デプロイ
* セキュリティ
* s3のバケットポリシー
* dbの設計図がごちゃついているのでおそらく正しく設計できていないと思う

## 今後追加(改善)したい機能
* 見た目関連
    * ボードと名乗っているのだから見た目を掲示板のようにする
    * 見た目を飾りつける
    * ポップアップ画面
    * アイコンを追加するなどして見やすく｡使いやすく
* 部屋関連
    * 部屋削除
    * 部屋から抜ける(グループ脱退)
    * プライベート部屋作成
    * プライベート部屋への申請
    * 招待
    * 追放
* カード関連
    * 自分が投稿したカードの削除
    * 誰がいつ投稿したか表示する
    * 投稿から1ヶ月､もしくは投稿の数が増えたら消える｡
* マイルーム
    * 同じ画像､同じ名前でも見分けられるようにプロフィールにid表示
    * 名前変更
    * メアド変更
    * 退会ボタンの移動
* その他
    * 他人のプロフィールと所属部屋を表示
    * フォロー機能
    * ヘルプページ
    * ニュースページ(更新内容など)
    * マイナス検索
    * スマホ版もリリースしたい
    ->スマホとサーバーをつなげてみたい
    * 送信ボタンの連打禁止
    * ドメインの作り直し

## FAQ
Q:phpとlaravelを使った理由は?
A:
* 現段階でサーバーサイド言語でまともに使える言語がphpしかなかったため｡
* 自分が企業サイトをみて回ったところ 12社中8社がphpとlaravelの組み合わせを採用していたため､私もこの組み合わせで作品を作ろうと考えたため｡

Q:ヘロクやレンタルサーバーではなくawsを使った理由は?
A:自分が企業サイトをみて回ったところ12社中10社がawsを使っているため少しは触っておこうと考えたため｡

Q:lightSailを選んだ理由は?
A:使用料金が固定で安いから
  採用当時はlightSailを使ったほうが簡単だと聞いたから
