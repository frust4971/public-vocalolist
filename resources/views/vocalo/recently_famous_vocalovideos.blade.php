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
{{Breadcrumbs::render('vocalo.recently_famous_vocalovideos',$page,$sort)}}
@endsection
@php 
    $queries = array();
    if(htmlspecialchars($sort) != 0 ) $queries['sort'] = htmlspecialchars($sort);
    if(isset($page)) $queries['page'] = htmlspecialchars($page);
@endphp
@section('contents')
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-8">
            <h2>最近話題のボカロ</h2>
            <br>
            <p>YouTubeで再生回数10万越えの話題になっているボカロ曲を集めました。<br>見逃してる曲がないか確認しよう！<br><div class="text-secondary">期間: ({{$newest_date}}～{{$oldest_date}})</div></p>
        </div>
    </div>
    <div class="row">
        <div class="dropdown text-right my-1  ml-lg-3 col-lg-7">
            <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if($sort == 1)
                再生回数順
            @else
                投稿日順
            @endif
            </button>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('vocalo.recently_famous_vocalovideos')}}">投稿日順</a>
                <a class="dropdown-item" href="{{route('vocalo.recently_famous_vocalovideos',['sort' => 1])}}">再生回数順</a>
            </div>
        </div>
    </div>
    <video-list table-name="recently_famous_vocalovideos" :queries='@json($queries)'></video-list>
    <div class="row">
        <div class="pr-lg-0 col-12 col-lg-7 d-flex justify-content-center justify-content-lg-end">{{$vocalovideos->appends($queries)->links('vendor.pagination.original_pagination_view')}}</div>
    </div>
    
@endsection