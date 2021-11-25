@extends('layouts.layout')
@section('title')
<title>歴代ボカロランキング | VocaloList</title>
@endsection
@section('description')
<meta name="description" content="YouTubeで公開されている歴史に名を刻んだボカロ曲をランキング形式で集めました。カラオケで歌うもよし、趣味で聴くのもよし。これだけ見ておけば間違いない！">
@endsection
@section('page_name')
<?php $page_name = 'vocalo'?>
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('vocalo.vocalo_ranking')}}
@endsection
@section('contents')
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-8">
            <h2>歴代ボカロランキング</h2>
            <br>
            <p>YouTubeで再生回数100万越えのボカロを集めました。<br>年検索で年代ごとのランキング作成もできます。懐かしいあの頃の曲を振り返ろう！<br>ランキングに入っていない曲やボカロではない曲の報告は<a href="{{route('contact')}}">こちら</a>へ。</p>
        </div>
    </div>
    <video-list :queries='@json($queries)' table-name="famous_vocalovideos" drop-down-type='year' use-edge-link="true" :use-condition-card="true"></video-list> 
    
@endsection