<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Knowledge Sharing Board

## リンク
http://knowledge-sharing-board.link

## データベース
https://docs.google.com/spreadsheets/d/e/2PACX-1vQi2tQKDiII57i1bj-A9YiEM0koHTnLu_QTmZo4P9-XfHAIUD7Cm-v6zqrVj4iYr0wYpkC_BAum1UjS/pubhtml

## 概要
記事や動画のurlをみんなでシェアする

## 使い方
会員登録､ログインが必須になりますが､本当のメールアドレスなどを入れる必要はなく適当な値を入れてしまって問題ありません｡  
右上にある画像のついたボタンを押すとメニューがでてきます｡後は難しい操作は無いはずなので画面をみればわかると思います｡
  
![スクリーンショット (2712)](https://user-images.githubusercontent.com/50346558/169234559-5dee6991-ac80-45d5-ab02-bd1986cab64d.png)

## 使った技術
* php
* laravel 
* bootstrap5!
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
* 出たばかりの最新バージョンではなく1つ前のバージョンでやったほうが情報が沢山あるので､別の対応をしなくて楽だったかもしれない<br>
-> 情報が多いバージョンでなれてから最新バージョンにふれるという順番が良いと思う
* lightSailで使えるphpのバージョンを確認してから制作すればもっと楽だったと思う<br>
->apacheをインストールしたりする練習にはなった

## 正直なところ理解が曖昧なところ
* 退会処理
* ページネイション
* リダイレクト
* append
* laravelのもっと細かいところ
* window.addEventListener('load', function(){});
* リファクタリング
* 会員登録のバリデーション
* apache関連
* デプロイ
* セキュリティ
* s3のバケットポリシー
* dbの設計図がごちゃついているのでおそらく正しく設計できていないと思う

## 今後追加(改善)したい機能
* 見た目関連
    * ボードと名乗っているのだから見た目を掲示板のようにする
    * 見た目を飾りつける
    * ポップアップ画面を使ってカードを作成したり､部屋を作成できるようにする
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
    * ニュースページ(更新内容､メンテナンスのお知らせなど)
    * マイナス検索
    * スマホ版もリリースしたい
    ->スマホとサーバーをつなげてみたい
    * 送信ボタンの連打禁止->重複登録はされないが503エラーページが表示されてしまう｡
    * ドメインの作り直し

## FAQ
Q:phpとlaravelを使った理由は?</br>
A:
* 現段階でサーバーサイド言語でまともに使える言語がphpしかなかったため｡
* 自分が企業サイトをみて回ったところ 12社中8社がphpとlaravelの組み合わせを採用していたため､私もこの組み合わせで作品を作ろうと考えたため｡

Q:ヘロクやレンタルサーバーではなくawsを使った理由は?</br>
A:自分が企業サイトをみて回ったところ12社中10社がawsを使っているため少しは触っておこうと考えたため｡</br>

Q:lightSailを選んだ理由は?</br>
A:使用料金が固定で安いから
  採用当時はlightSailを使ったほうが簡単だと聞いたから</br>
  
Q:ssl化されていないのはなぜ?  
A:こちらの不手際により､ssl化されるまで時間制限(〇〇時間たつまで認証できない)がかけられてしまったから

### 参考にしたサイト
* laravel
    * [LaravelのSQLインジェクション対策について、XSSとの違いと共に分かりやすく解説](https://biz.addisteria.com/laravel_sql_injection)
    * [Laravel・データベースからデータ取得する全実例](https://blog.capilano-fw.com/?p=665)
    * [【Laravel】キーワード検索機能の実装方法（複数キーワード、部分一致）](https://takuma-it.com/laravel-keyword-search/)
    * [Laravelの二重送信対策](https://kodyblog.com/duplicate-transmission-measures/)
    * [【Laravel】リダイレクトの書き方メモ](https://qiita.com/manbolila/items/767e1dae399de16813fb)
    * [Laravel8 でPaginationを簡単に美しく実装する方法【Bootstrap利用】](https://biz.addisteria.com/laravel8_pagination/)
    * [【Laravel】論理削除を利用して退会機能を実装する](https://qiita.com/179Bell/items/2bf6a58d9314f5f00eeb)
    * [LaravelでSeederを使う方法！(初期データを登録する)](https://codelikes.com/laravel-seeder/)
* aws
    * [Amazon Lightsail入門 〜AWSで最も安く簡単にLaravel(PHP)サーバー構築を実践しよう！〜](https://www.udemy.com/share/105nMg3@QMR6VRtHsxtCNI-qwQS7IeavG6NuNTsdXT9SKvq3oDXusxBTzlTUitNH6OKcZB8CrQ==/)
    * [Amazon LightsailにPHP8系のLAMP環境を構築してみた](https://juno-blog.site/article/amazon-lightsail-ubuntu-php8/)
    * [Ubuntu20.04にComposerをインストールする手順](https://mebee.info/2020/06/02/post-10844/)
* apache
    *  [apacheでForbiddenが出た時の設定の見直し方法](https://arc-tech.hatenablog.com/entry/2019/09/27/093513)
    *  [index意外のページにアクセスすると404エラーが発生する](https://teratail.com/questions/47368)
    *  [Ubuntu で apache2のDocument rootを変更する方法](https://qiita.com/bluesDD/items/3cf77298ece0c83e9968)
* javascript
    * [jQueryを使わずにスライドメニューを実装しよう](https://www.webcreatorbox.com/tech/slide-menu)
    * [JavaScript | テキストエリアで入力可能な残り文字数を表示する方法](https://1-notes.com/javascript-number-of-characters-remaining-in-the-textarea/)
    * [CSSとJavaScriptでWebページにローディングアニメーションを表示させる方法](https://www.webcreatorbox.com/tech/loading-animation)
* html&css
    * [1行追加でOK！CSSだけで画像をトリミングできる「object-fit」プロパティー](https://www.webcreatorbox.com/tech/object-fit)
    * [HTMLのinputに入力制限をつける方法を解説！文字数や半角英数の指定なども](https://web-camp.io/magazine/archives/85005)
    * [HTML のリンクを新しいタブで開くようにする方法](https://www.freecodecamp.org/japanese/news/how-to-use-html-to-open-link-in-new-tab/)
    * [HTMLでrequired属性を使って入力フォームに必須項目を作る方法を現役デザイナーが解説](https://techacademy.jp/magazine/28499)
    * [入力フォームのデザインのコツ20選！入力されるフォームを豊富な画像で解説](https://form.run/media/contents/design/form-design/)
