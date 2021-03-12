@extends('layouts.layout')
@section('title')
VocaloList|このサイトについて
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('info.about_site')}}
@endsection
@section('contents')
<div class="comment">
            <br>
            <h2>このサイトについて</h2>
            <br>
            <p>ボカロを愛する管理人がこんなサイトがあったらいいなというノリと勢いで作成しました</p>
            <p>アクセス数が増えるとモチベーションも上がるので、こんな機能が欲しいなどがあったらブックマークに登録してくれるとそのうち対応するかもしれない</p>
            <p>見てくれる人が増える→便利な機能が追加される→皆も幸せ、管理人も幸せ<br>あはっ☆いいことづくめだね</p>
        </div>
        <div class="card">
            <div class="card-header">
                <b>目次</b>
            </div>
            <div class="card-body">
                ・<a class="text-dark" href="#vocalo">ボカロ</a>
                <br>
                ・<a class="text-dark" href="#utattemita">歌ってみた</a>
                <br>
                ・<a class="text-dark" href="#bulletin_board">掲示板</a>
                <br>
                ・<a class="text-dark" href="#plan">今後の予定</a>
            </div>
        </div>
        <br>
        <div class="content mb-5">

            <h3 id="vocalo">ボカロ</h3><br>
            <p>YouTubeで「ボカロ」や「VOCALOID」と検索してタイトルでランキングとかメドレーとかはいっているものを抜いて集めるという流れ</p>
            <h5>歴代ランキング</h5>
            <div class="row ml-2">
                <p>YouTubeにあるボカロの歴代ランキングを表示するページ。自動で集めてるから抜けてる動画があるかもしれない</p><br>
            </div>
            <h5>最近話題のボカロ</h5>
            <div class="row ml-2">
                <p>直近で再生回数10万越えのボカロ動画を表示するページ。なるべくボカロ以外の動画が入らないよう工夫はしたけど、たまにボカロ以外の動画が入ったりボカロで10万超えてるのに動画が入ってないということもある<br>判定条件は管理人が独断で決めたものなので報告できるようになったら報告していただきたい</p><br>
            </div>
            <h5>ボカロガチャ</h5>
            <div class="row ml-2">
                <p>再生回数100万越えのボカロ動画をランダムで探してくるページ。なにが出るかはその日の運次第！</p>
            </div>
        </div>
        <div class="content mb-5">

            <h3 id="utattemita">歌ってみた</h3><br>
            <p>YouTubeで「ボカロ　歌ってみた」、「ボカロ　cover」と検索し、タイトルで関係なさそうな動画を判定してそれ以外を収集という流れ<br><br>判定条件が難しすぎるのでボカロ動画より甘め、現在のNGワードはこんなかんじ</p>
            <div class="card">
                <div class="card-body">ランキング、メドレー、替え歌、再生</div>
            </div><br><br>
            <h5>最近話題の歌ってみた</h5>
            <div class="row ml-2">
                <p>直近で再生回数10万越えの動画を表示するページ。ボカロかどうかの判定が難しいので違う動画がよく入る。今の条件よりいい条件が見つかったら教えてほしい</p>
            </div>

        </div>
        <div class="content mb-5">

            <h3 id="bulletin_board">掲示板</h3><br>
            <p>いつかは作る予定。ボカロを集めるデータベースと同じデータベースを使用するつもりだけどそれで表示速度遅くなることだけが心配<br>求ム、有識者</p>

        </div>
        <div class="content mb-5">

            <h3 id="plan">今後の予定</h3><br>
            <p>順番は特に決めてませんが今のところ以下のことをするつもりです</p>
            <div class="card">
                <div class="card-body">
                    <p>広告取得：金欠です。サーバー代をください</p>
                    <p>メールフォーム作成：訪問者さまさまの意見をきくのに必要</p>
                    <p>掲示板作成：あったら楽しいよね</p>
                    <p>ボカロの人気動画を年代で取得する機能の追加</p>
                </div>
            </div>

        </div>
        <br>
@endsection