@extends('layouts.layout')
@section('title')
<title>最近話題のボカロ歌ってみた | VocaloList</title>
@endsection
@section('description')
<meta name="description" content="YouTubeで再生回数10万越えの最近話題になっている歌ってみた動画を集めました。投稿日順やランキング順で見逃している動画がないか確認しよう！好みの歌い手に出会えるかもしれない">
@endsection
@section('page_name')
<?php $page_name = 'utattemita'?>
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('utattemita.recently_famous_utattemita')}}
@endsection
@section('contents')
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-6">
            <h2>最近話題の歌ってみた</h2>
            <br>
            <p>YouTubeで再生回数10万越えの話題になっている歌ってみたを集めました。<br>お気に入りの歌い手さんに出会えるかも！<div class="text-secondary">期間: ({{$newest_date}}～{{$oldest_date}})</div></p>
        </div>
    </div>
    <video-list :queries='@json($queries)' table-name="recently_famous_utattemita" drop-down-type='normal'></video-list> 
@endsection