@extends('layouts.layout')
@section('title')
<title>VocaloList(ボカロリスト) - 気になるボカロを集めるサイト</title>
@endsection
@section('description')
<meta name="description" content="話題になっている人気ボカロ曲や歌ってみた動画を毎日更新！歴代ランキングもあります。カラオケで歌う曲探しにもおすすめです。">
@endsection
@section('style')
<style>
        .ytp-title-text {
            max-width: 100%;
            overflow: hidden;
            white-space: nowrap;
            word-wrap: normal;
            text-overflow: ellipsis;
        }

        .ytp-title-text {
            color:#EEEEEE;
            vertical-align: top;
            padding-top: 12px;
            font-size: 18px;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            -moz-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            position:absolute;
            left:12px;
            right:12px;
            z-index: 1;
            text-shadow: 1px  1px 1px black;
        }
        .ytp-title {
            min-height: 52px;
        }

</style>
@endsection
@section('page_name')
<?php $page_name = 'home'?>
@endsection
@section('contents')
<br>
<div class="row">
    <div class="col-12">ボカロリストへようこそ！！<br>このサイトでは最近注目度の高いボカロ関係の動画を毎日、自動で更新しています。<br>ゆるーく楽しんでいってください。</div>
</div>
<br>
<div class="card">
    <a class="text-dark" href="{{route('vocalo.recently_famous_vocalovideos')}}"><div class="card-header"><b>最近話題のボカロ</b></div></a>
    <div class="card-body">
    <div id="carouselVocalovideosIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselVocalovideosIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselVocalovideosIndicators" data-slide-to="1"></li>
                <li data-target="#carouselVocalovideosIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">

                @for($i = 0; $i < 3; $i++)
                    <div class="carousel-item {{$i == 0 ? 'active' : NULL}}">
                        <div class="display-if-lg-or-more">
                            <div class="d-none d-lg-flex">
                                @for($j = $i * 3; $j < ($i + 1) * 3; $j++)
                                    <div class="col-4 p-1">
                                        <a href="{{route('vocalo.recently_famous_vocalovideos.show',['id' => $pickup_vocalovideos[$j]->video_id])}}" style="display:block;">
                                            <div class="ytp-title ytp-title-text">{{$pickup_vocalovideos[$j]->title}}</div>
                                            <img src="http://i.ytimg.com/vi/{{$pickup_vocalovideos[$j]->video_id}}/maxresdefault.jpg" class="w-100 youtube-thumbnail">
                                        </a>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="display-if-under-lg">
                            <div class="d-lg-none d-block">
                                <div class="col-12">
                                    <a href="{{route('vocalo.recently_famous_vocalovideos.show',['id' => $pickup_vocalovideos[$i]->video_id])}}" style="display:block;">
                                        <div class="ytp-title ytp-title-text pl-2">{{htmlspecialchars_decode($pickup_vocalovideos[$i]->title,ENT_QUOTES)}}</div>
                                        <img src="http://i.ytimg.com/vi/{{$pickup_vocalovideos[$i]->video_id}}/maxresdefault.jpg" class="w-100 youtube-thumbnail">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <a class="carousel-control-prev h-25 my-auto" href="#carouselVocalovideosIndicators" role="button" data-slide="prev" style="width:60px">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next h-25 my-auto" href="#carouselVocalovideosIndicators" role="button" data-slide="next" style="width:60px">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="card">
    <a class="text-dark" href="{{route('utattemita.recently_famous_utattemita')}}"><div class="card-header"><b>最近話題の歌ってみた</b></div></a>
    <div class="card-body">
        <div id="carouselUtattemitaIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselUtattemitaIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselUtattemitaIndicators" data-slide-to="1"></li>
                <li data-target="#carouselUtattemitaIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
            <div class="row">
            @for($i = 0; $i < 3; $i++)
                <div class="carousel-item {{$i == 0 ? 'active' : NULL}}">
                    <div class="display-if-lg-or-more">
                        <div class="d-none d-lg-flex">
                            @for($j = $i * 3; $j < ($i + 1) * 3; $j++)
                                <div class="col-4 p-1">
                                    <a href="{{route('utattemita.recently_famous_utattemita.show',['id' => $pickup_utattemita[$j]->video_id])}}" style="display:block;">
                                        <div class="ytp-title ytp-title-text">{{$pickup_utattemita[$j]->title}}</div>
                                        <img src="http://i.ytimg.com/vi/{{$pickup_utattemita[$j]->video_id}}/maxresdefault.jpg" class="w-100 youtube-thumbnail">
                                    </a>
                                </div>
                            @endfor
                        </div>

                    </div>
                    <div class="display-if-under-lg">
                        <div class="d-lg-none d-block">
                            <div class="col-12">
                                <a href="{{route('utattemita.recently_famous_utattemita.show',['id' => $pickup_utattemita[$i]->video_id])}}" style="display:block;">
                                    <div class="ytp-title ytp-title-text pl-2">{{$pickup_utattemita[$i]->title}}</div>
                                    <img src="http://i.ytimg.com/vi/{{$pickup_utattemita[$i]->video_id}}/maxresdefault.jpg" class="w-100 youtube-thumbnail">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endfor
            </div>
            <a class="carousel-control-prev h-25 my-auto" href="#carouselUtattemitaIndicators" role="button" data-slide="prev" style="width:60px">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next h-25 my-auto" href="#carouselUtattemitaIndicators" role="button" data-slide="next" style="width:60px">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        <b>お知らせ</b>
    </div>
    <div class="card-body">
        <a href="{{route('vocalo.vocalo_ranking')}}" class="text-dark"><div>歴代ボカロランキングに年検索を追加しました (2021/09/21)</div></a>
        <a href="{{route('contact')}}" class="text-dark"><div>お問い合わせフォームを設置しました (2021/04/18)</div></a>
    </div>
</div>
<br>
<p><a href="{{route('info.about_site')}}">このサイトについて</a></p>
<br>
@endsection