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
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-6">
            <h2>ボカロガチャ</h2>
        </div>
    </div>
    <div class="ml-lg-3">
        <p>再生回数100万越えのボカロをランダムで探すよ。</p>
        <p>好みの曲と出会えるといいね！</p>
        <img src="/image/folder.png" class="ml-3" width="150" height="150">
        <br>
        <a href="{{route('vocalo.gacha_result')}}"><button type="button" class="btn btn-danger mt-2 ml-4"><b>ガチャる</b></button></a>
        <br>
        <br>
    </div>
@endsection