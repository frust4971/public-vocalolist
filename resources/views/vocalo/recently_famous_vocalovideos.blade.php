@extends('layouts.layout')
@section('title')
<title>最近話題のボカロ | VocaloList</title>
@endsection
@section('description')
<meta name="description" content="YouTubeで再生回数10万越えの最近話題になっている人気ボカロ曲を集めました。投稿日順やランキング順で見逃している曲がないか確認しよう！まだ見ぬ有名ボカロPに出会えるかもしれない">
@endsection
@section('page_name')
<?php $page_name = 'vocalo'?>
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('vocalo.recently_famous_vocalovideos')}}
@endsection
@section('contents')
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-8">
            <h2>最近話題のボカロ</h2>
            <br>
            <p>YouTubeで再生回数10万越えの話題になっているボカロ曲を集めました。<br>見逃してる曲がないか確認しよう！<br><div class="text-secondary">期間: ({{$newest_date}}～{{$oldest_date}})</div></p>
        </div>
    </div>
    <video-list :queries='@json($queries)' table-name="recently_famous_vocalovideos" drop-down-type='normal' use-edge-link="false" :use-condition-card="true"></video-list> 
@endsection