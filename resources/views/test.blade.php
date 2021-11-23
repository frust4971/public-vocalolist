@extends('layouts.layout')
@section('title')
<title>ボカロガチャ | VocaloList</title>
@endsection
@section('description')
<meta name="description" content="YouTubeで再生回数100万越えの超人気ボカロ曲でガチャ！まだあなたの知らない名曲を見つけられるかもしれない...見つけられなくても最近聴いてなかったあの曲をもう一度聴くのも面白いよ！">
@endsection
@section('page_name')
<?php $page_name = 'vocalo'?>
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('vocalo.vocalo_gacha')}}
@endsection
@section('contents')
    <video-list table-name="famous_vocalovideos" page-name="歴代ボカロランキング"></video-list>
@endsection