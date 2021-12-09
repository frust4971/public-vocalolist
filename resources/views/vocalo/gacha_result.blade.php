@extends('layouts.layout')
@section('title')
<title>ボカロガチャ結果 | VocaloList</title>
@endsection
@section('meta')
<meta name="robots" content="noindex" />
@endsection
@section('page_name')
<?php $page_name = 'vocalo'?>
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('vocalo.gacha_result')}}
@endsection
@section('contents')
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-6">
            <h2>ガチャ結果</h2>
        </div>
    </div>
    <video-list :queries='@json($queries)' table-name="recently_famous_vocalovideos" :use-condition-card="true"></video-list> 
@endsection