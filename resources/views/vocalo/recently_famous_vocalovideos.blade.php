@extends('layouts.layout')
@section('title')
<title>最近話題のボカロ | VocaloList</title>
@endsection
@section('description')
<meta name="description" content="YouTubeで再生回数10万越えの最近話題になっている人気ボカロ曲を集めました。投稿日順やランキング順で見逃している曲がないか確認しよう！まだ見ぬ有名ボカロPに出会えるかもしれないぞ">
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
                <a class="dropdown-item" href="/vocalo/recently_famous_vocalovideos">投稿日順</a>
                <a class="dropdown-item" href="{{route('vocalo.recently_famous_vocalovideos',['sort' => 1])}}">再生回数順</a>
            </div>
        </div>
    </div>
    @for($i = 0;$i < count($vocalovideos);$i++)
        <div class="content px-2 py-lg-3 py-2">
            <div class="row">
                <h1 class="col-1 text-center"><span class="badge badge-secondary">{{$page > 0?10*($page-1)+$i+1:$i+1}}</span></h1>
                <div class="col-lg-6 p-0">
                    <a href="{{route('vocalo.recently_famous_vocalovideos.show',['id' => $vocalovideos[$i]->video_id])}}" style="display:block;">
                        <img src="http://i.ytimg.com/vi/{{$vocalovideos[$i]->video_id}}/maxresdefault.jpg" class="w-100 youtube-thumbnail">
                    </a>
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
        if(htmlspecialchars($sort) != 0 ) $queries['sort'] = htmlspecialchars($sort);
    ?>
    {{$vocalovideos->appends($queries)->links('vendor.pagination.original_pagination_view')}}
@endsection