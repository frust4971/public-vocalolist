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
{{Breadcrumbs::render('vocalo.vocalo_ranking',$page,$year,$vocaloid)}}
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
    if(isset($vocaloid)) $queries['vocaloid'] = htmlspecialchars($vocaloid);
?>
@section('contents')
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-8">
            <h2>歴代ボカロランキング</h2>
            <br>
            <p>YouTubeで再生回数100万越えのボカロを集めました。<br>年検索で年代ごとのランキング作成もできます。懐かしいあの頃の曲を振り返ろう！<br>ランキングに入っていない曲やボカロではない曲の報告は<a href="{{route('contact')}}">こちら</a>へ。</p>
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
                <?php
                    $year_queries = $queries;
                    unset($year_queries['year']);
                ?>
                <a class="dropdown-item" href="{{route('vocalo.vocalo_ranking',$year_queries)}}">-</a>
            @foreach($years as $y)
                <?php
                    $year_queries = $queries;
                    $year_queries['year'] = $y;
                ?>
                <a class="dropdown-item" href="{{route('vocalo.vocalo_ranking',$year_queries)}}">{{$y}}</a>
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
                    <h1 class="col-lg-1 d-none d-lg-block text-center pl-0 pl-0"><span class="badge badge-secondary">{{$page > 0?10*($page-1)+$i+1:$i+1}}</span></h1>
                    <div class="col-lg-6 p-0">
                        <?php 
                            $video_queries = $queries;
                            $video_queries['id'] = $vocalovideos[$i]->video_id;
                        ?>
                        <a href="{{route('vocalo.vocalo_ranking.show',$video_queries)}}" style="display:block;position:relative;">
                            <h1 class="d-lg-none text-center rank"><span class="badge badge-secondary">{{$page > 0?10*($page-1)+$i+1:$i+1}}</span></h1>
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
    <div class="row">
        <div class="pr-lg-0 col-12 col-lg-7 d-flex justify-content-center justify-content-lg-end">{{$vocalovideos->appends($queries)->links('vendor.pagination.ranking_pagination_view')}}</div>
    </div>
    <br>
    <div class="row">
        <div class=" col-lg-7">
            <div class="card shadow">
                <div class="card-body">
                    <div class="h5 mb-3">キャラクターで探す</div>
                    <ul style="display:flex;flex-wrap:wrap;">
                    @foreach(config('const.VOCALOIDS') as $VOCALOID)
                    <?php 
                            $vocaloid_queries = $queries;
                            if(isset($vocaloid_queries['vocaloid']) and $vocaloid_queries['vocaloid'] != $VOCALOID){
                                unset($vocaloid_queries['page']);
                            }
                            $vocaloid_queries['vocaloid'] = $VOCALOID;
                        ?>
                        <li class="mx-1 mb-2 btn btn-secondary" style="width:90px"><a class="text-light text-decoration-none" href="{{route('vocalo.vocalo_ranking',$vocaloid_queries)}}">{{$VOCALOID}}</a></li>
                    @endforeach
                    
                    </ul>
                    <div class="mx-1 mb-2 btn btn-secondary float-right"><a class="text-light text-decoration-none" href="{{route('vocalo.vocalo_ranking')}}">指定なし</a></div>
                </div>
            </div>
        </div>
    </div>
    
@endsection