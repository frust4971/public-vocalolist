@extends('layouts.layout')
@section('title')
<title>最近話題のボカロ | VocaloList</title>
@endsection
@section('meta')
<meta name="robots" content="noindex" />
@endsection
@section('page_name')
<?php $page_name = 'vocalo'?>
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('vocalo.recently_famous_vocalovideos')}}
@endsection
@section('contents')
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-6">
            <h2>最近話題のボカロ</h2>
        </div>
    </div>

    <div class="content px-2 py-lg-3 py-2">
        <div class="row">
            <div class="col-lg-1 col-0"></div>
            <div class="embed-responsive embed-responsive-16by9 col-lg-8">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$vocalovideo->video_id}}"></iframe>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-1 col-0"></div>
            <h2 class="col-lg-8 bg-light py-2 border-left border-primary">{{htmlspecialchars_decode($vocalovideo->title,ENT_QUOTES)}}</h2>
        </div>
        <div class="row">

            <div class="col-lg-1 col-0"></div>
            <div class="col-lg-4 col-6 text-left">再生回数<div class="font-weight-bold">{{$vocalovideo->view_count}}</div></div>
            <div class="col-lg-4 col-6 text-right my-2">{{$vocalovideo->published_at}}</div>
        </div>
    </div>

@endsection