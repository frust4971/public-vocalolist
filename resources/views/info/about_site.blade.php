@extends('layouts.layout')

@section('title')
<title>このサイトについて|VocaloList</title>
@endsection

@section('style')
<style>
    h5{
        padding: 10px;
    }
</style>
@endsection

@section('breadcrumbs')
{{Breadcrumbs::render('info.about_site')}}
@endsection

@section('contents')
<div class="comment">
    <br>
    <h2>このサイトについて</h2>
    <br>
    <p>ボカロを愛する管理人が「こんなサイトあったらいいなぁ」というノリと勢いで作成しました</p>
    <p>アクセス数が増えるとモチベーションも上がるので、こんな機能が欲しいなどがあったらブックマークに登録してくれるとそのうち対応します</p>
    <p>見てくれる人が増える→便利な機能が追加される→皆も幸せ、管理人も幸せ<br><br>あはっ☆いいことづくめだね！</p>
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
    <p>YouTubeで「ボカロ」や「VOCALOID」など、ボカロ関連の検索ワードで検索してタイトルでランキングとかメドレーとかはいっているもの以外を集めるという流れです<br><br>実際はもっとNGワード多いけどイメージ的には大体そんな感じ<br><br>自動で集めてるから抜けてる動画があるかもしれないです。そういう動画があったら手動で入れることにしてます</p><br>
    <h5 class="border-left border-dark">歴代ランキング</h5>
    <div class="ml-lg-1">
        <p>YouTubeにあるボカロの歴代ランキングを表示するページです<br><br>半年に一回更新したりしなかったりします<br>なぜかっていうと動画が多すぎていっぺんに更新処理をしようとすると、Googleさんが<br><br>「君ぃ、ちょっとサイトに負荷かけすぎじゃない？」<br><br>って言ってくるから<br><br></p>
    </div>
    <h5 class="border-left border-dark">最近話題のボカロ</h5>
    <div class="ml-lg-1">
        <p>直近で再生回数10万越えのボカロ動画を表示するページです<br><br>最近の流行りを抑えたいならとりあえずここ！<br><br>なるべくボカロ以外の動画が入らないよう工夫はしたけど、たまーーにボカロ以外の動画が入ることがないこともないです<br><br>判定条件は日々改善していくつもり。<strong>成長性を売りにしていきたい</strong><br><br></p>
    </div>
    <h5 class="border-left border-dark">ボカロガチャ</h5>
    <div class="ml-lg-1">
        <p>再生回数100万越えのボカロ動画をランダムで探してくるページです<br><br>なにが出るかはその日の運次第！<br><br></p>
    </div>
</div>
<div class="content mb-5">

    <h3 id="utattemita">歌ってみた</h3><br>
    <p>YouTubeで「ボカロ　歌ってみた」、「ボカロ　cover」と検索し、タイトルで関係なさそうな動画を判定してそれ以外を収集という流れです<br><br>判定条件が難しすぎるのでボカロより甘め<br><br>ボカロの場合は検索するとき、再生回数順のみで集めてるけど、歌ってみたは関連度順でも集めることにしてます<br><br>（（なぜなら判定条件が難しすぎるから））</p><br>
    <h5 class="border-left border-dark">最近話題の歌ってみた</h5>
    <div class="ml-lg-1">
        <p>直近で再生回数10万越えの動画を表示するページです<br><br>いつまでに投稿された動画を収集するかは以下の理由で調整が必要です<br></p>   
        <div class="card">
            <div class="card-body">
                <p>期間を長くする→有名動画は入るけど最近の動画が入りにくくなる</p>
                <p>期間を短くする→短期間で再生回数10万越えの動画しか入らなくなる</p>
            </div>
        </div>
        <br>
        <p>よほど無理な条件でなければ、短期間に近づけるべきじゃないかと思いましたが、それだと知名度とかで変わってきちゃうのかなぁという気も<br><br>じわじわ評価されていく動画も集めていきたいので、様子を見ながら改善していきます</p>
    </div>

</div>
<div class="content mb-5">

    <h3 id="bulletin_board">掲示板</h3><br>
    <p>いつかは作る予定です<br><br>今のデータベース（情報を入れておくところ）だと容量少なすぎて掲示板入れるのはぜーーーったいムリ！<br><br>人が集まってきて、性能のいいデータベース借りれるようになったら実装します</p>

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