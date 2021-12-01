@extends('layouts.layout')

@section('title')
<title>このサイトについて | VocaloList</title>
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
<div class="col-lg-8">
<div class="comment">
    <br>
    <h2>このサイトについて</h2>
    <br>
    <p>ボカロを愛する管理人が少しでもボカロ界隈がにぎわって欲しいという思いで作成しました</p>
    <p>アクセス数が増えるとモチベーションも上がるので、ブックマークに登録してくれると嬉しいです</p>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card mt-5">
            <div class="card-header">
                <b>目次</b>
            </div>
            <div class="card-body">
                ・<a class="text-dark" href="#home">Home</a>
                <br>
                ・<a class="text-dark" href="#vocalo">ボカロ</a>
                <br>
                ・<a class="text-dark" href="#utattemita">歌ってみた</a>
                <br>
                ・<a class="text-dark" href="#contact">お問い合わせ</a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="content my-5">

    <h3 id="Home">Home</h3><br>
    <p>パソコンだと9件づつ、スマホやタブレットだと3件づつ、新しく集めた動画を表示してます</p>
    <p>何かお知らせがあるときは、このページの下のところで告知します</p>
</div>
<div class="content my-5">

    <h3 id="vocalo">ボカロ</h3><br>
    <p>YouTubeで「ボカロ」や「VOCALOID」など、ボカロ関連のワードで検索した結果を集めたページです<br><br>100個まで動画情報を保存しています<br><br>自動で集めてるから抜けてる動画があるかもしれないです。そういう動画があったら手動で入れることにしてます</p><br>
    <h5 class="border-left border-dark">歴代ランキング</h5>
    <div class="ml-lg-1">
        <p>YouTubeにあるボカロの歴代ランキングを表示するページです</p>
        <p>年代検索であの頃の曲を探すのも楽しいかも</p>
    </div>
    <h5 class="border-left border-dark">最近話題のボカロ</h5>
    <div class="ml-lg-1">
        <p>直近で再生回数10万越えのボカロ動画を表示するページです<br><br>最近の流行りを抑えたいならとりあえずここ！<br><br>なるべくボカロ以外の動画が入らないよう工夫はしましたが、たまーーにボカロ以外の動画が入ることがないこともないです<br><br>判定条件は日々改善していくつもりです<br><br></p>
    </div>
    <h5 class="border-left border-dark">ボカロガチャ</h5>
    <div class="ml-lg-1">
        <p>再生回数100万越えのボカロ動画をランダムで探してくるページです<br><br>なにが出るかはその日の運次第<br><br></p>
    </div>
</div>
<div class="content my-5">

    <h3 id="utattemita">歌ってみた</h3><br>
    <p>YouTubeで「ボカロ　歌ってみた」、「ボカロ　cover」と検索し、関係なさそうな動画をはじいて結果を集めています<br><br>判定条件が難しすぎるのでボカロより甘め<br><br>ボカロの場合は検索するとき、再生回数順のみで集めてますが、歌ってみたは関連度順でも集めることにしてます<br><br>（（なぜなら判定条件が難しすぎるから））</p><br>
    <h5 class="border-left border-dark">最近話題の歌ってみた</h5>
    <div class="ml-lg-1">
        <p>直近で再生回数10万越えの動画を表示するページです<br><br>100個まで動画情報を保存しています<br></p>   
    </div>

</div>
<div class="content my-5">

    <h3 id="contact">お問い合わせ</h3><br>
    <p>お問い合わせフォームです<br><br>欲しい機能だったり、伝えたいことがあるときに使ってください<br><br>一日一回まで送信できます</p>

</div>
<br>
</div>
@endsection