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
    @for($i = 0;$i < count($vocalovideos);$i++)
        <div class="content px-2 py-lg-3 py-2">
            <div class="row">
                <h1 class="col-1 text-center"><span class="badge badge-secondary">{{$page > 0?10*($page-1)+$i+1:$i+1}}</span></h1>
                <div class="embed-responsive embed-responsive-16by9 col-lg-6">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$vocalovideos[$i]->video_id}}"></iframe>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-1 col-0"></div>
                <h2 class="col-lg-6 bg-light py-2 border-left border-primary">{{htmlspecialchars_decode($vocalovideos[$i]->title,ENT_QUOTES)}}</h2>
            </div>
            <div class="row">

                <div class="col-lg-1 col-0"></div>
                <div class="col-lg-3 col-6 text-left">再生回数<div class="font-weight-bold">{{$vocalovideos[$i]->view_count}}</div></div>
                <div class="col-lg-3 col-6 text-right my-2">{{$vocalovideos[$i]->published_at}}</div>
            </div>
        </div>
    @endfor
    <?php 
        $queries = array();
        if(htmlspecialchars($seed) != 0 ) $queries['seed'] = htmlspecialchars($seed);
    ?>
    {{$vocalovideos->appends($queries)->links('vendor.pagination.original_pagination_view')}}
@endsection