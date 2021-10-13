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
{{Breadcrumbs::render('vocalo.vocalo_ranking',$page,$year)}}
@endsection
<?php
    $years = [];
    for($i = date('Y');$i >= 2007 ;$i--){
        $years[] = $i;
    }
?>
<?php 
    $queries = array();
    if(isset($page)) $queries['page'] = htmlspecialchars($page);
    if(htmlspecialchars($year) != 0 ) $queries['year'] = htmlspecialchars($year);
?>
@section('contents')
    <div class="row">
        <div class="h2 ml-lg-4 mt-4 col-lg-6">
            歴代ボカロランキング
        </div>
    </div>
    <div class="row">
        <div class="dropdown text-right my-1  ml-lg-3 col-lg-7">
        
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if($year != 0)
                {{$year}}
            @else
                年検索
            @endif
            </button>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('vocalo.vocalo_ranking')}}">-</a>
            @foreach($years as $y)
                <a class="dropdown-item" href="{{route('vocalo.vocalo_ranking',['year' => $y])}}">{{$y}}</a>
            @endforeach 
            </div>
        
        </div>
    </div>
    @if(count($vocalovideos) === 0)
        <div class="row">
            <div class="h4 col-lg-6  ml-lg-4 mb-5">見つかりませんでした...</div>
        </div>
    @else
        @for($i = 0;$i < count($vocalovideos);$i++)
            <div class="content px-2 py-5">
                <div class="row">
                    <h1 class="col-1 text-center pl-0 pl-0"><span class="badge badge-secondary">{{$page > 0?10*($page-1)+$i+1:$i+1}}</span></h1>
                    <div class="col-lg-6 p-0">
                        <?php 
                            $video_queries = $queries;
                            $video_queries['id'] = $vocalovideos[$i]->video_id;
                        ?>
                        <a href="{{route('vocalo.vocalo_ranking.show',$video_queries)}}" style="display:block;">
                            <img src="http://i.ytimg.com/vi/{{$vocalovideos[$i]->video_id}}/maxresdefault.jpg" class="w-100  youtube-thumbnail">
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-1 col-0"></div>
                    <h2 class="col-lg-6 bg-light py-2 border-left border-primary content-title">{{htmlspecialchars_decode($vocalovideos[$i]->title,ENT_QUOTES)}}</h2>
                </div>
                <div class="row">
                    <div class="col-lg-1 col-0"></div>
                    <div class="col-lg-3 col-6 text-left">再生回数<div class="font-weight-bold">{{$vocalovideos[$i]->view_count}}</div></div>
                    <div class="col-lg-3 col-6 text-right my-2">{{$vocalovideos[$i]->published_at}}</div>
                </div>
            </div>
        @endfor
    @endif
    {{$vocalovideos->appends($queries)->links('vendor.pagination.ranking_pagination_view')}}
@endsection