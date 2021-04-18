@extends('layouts.layout')
@section('title')
<title>VocaloList - 気になるボカロを集めるサイト</title>
@endsection
@section('description')
<meta name="description" content="話題になっているボカロ曲や歌ってみた動画を毎日更新！歴代ランキングもあります。">
@endsection
@section('page_name')
<?php $page_name = 'home'?>
@endsection
@section('contents')
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
<<<<<<< HEAD
            <div class="row">
            @for($i = 0; $i < 3; $i++)
                <div class="carousel-item {{$i == 0 ? 'active' : NULL}}">
                    <div class="display-if-lg-or-more">
                        <div class="d-none d-lg-flex">
                        @for($j = $i * 3; $j < ($i + 1) * 3; $j++)
                                <div class="embed-responsive embed-responsive-16by9 carousel-grid col-4">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[$j]->video_id}}"></iframe>
                                </div>
                        @endfor
=======

                @for($i = 0; $i < 3; $i++)
                    <div class="carousel-item {{$i == 0 ? 'active' : NULL}}">
                        <div class="display-if-lg-or-more">
                            <div class="d-none d-lg-flex">
                                @for($j = $i * 3; $j < ($i + 1) * 3; $j++)
                                    <div class="embed-responsive embed-responsive-16by9 col-4">
                                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[$j]->video_id}}"></iframe>
                                    </div>
                                @endfor
                            </div>
>>>>>>> 040c729 (divの数でバグがあった。修正)
                        </div>
                        <div class="display-if-under-lg">
                            <div class="d-lg-none d-block">
                                <div class="embed-responsive embed-responsive-16by9  col-12">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[$i]->video_id}}"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
                </div>
            @endfor
            </div>
=======
                @endfor

>>>>>>> 040c729 (divの数でバグがあった。修正)
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
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-4">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_utattemita[$j]->video_id}}"></iframe>
                            </div>
                        @endfor
                        </div>

                    </div>
                    <div class="display-if-under-lg">
                        <div class="d-lg-none d-block">
                            <div class="embed-responsive embed-responsive-16by9  col-12">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_utattemita[$i]->video_id}}"></iframe>
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
        <b>人気スレ</b>
    </div>
    <div class="card-body">
        <p>お前らのオススメ曲教えろ(12)</p>
        <p>※まだ掲示板は作成していません。今後こんな感じにする予定です</p>
    </div>
</div>
<br>
<div class="card">
    <div class="card-header">
        <b>お知らせ</b>
    </div>
    <div class="card-body">
        <a href="{{route('info.about_site')}}">このサイトについて</a>
    </div>
</div>
<br>
@endsection