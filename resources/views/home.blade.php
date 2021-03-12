@extends('layouts.layout')
@section('title')
<title>VocaloList|ボカロのことならおまかせ！歴代ランキングから最近話題の歌ってみたまで</title>
@endsection
@section('description')
<meta name="description" content="ボカロを聴くならVocaloList。話題になっているボカロ曲や歌ってみた動画を毎日更新！超有名ボカロ曲のガチャもあるよ">
@endsection
@section('contents')
<br>
<div class="card">
    <div class="card-header">
        <b>お知らせ</b>
    </div>
    <div class="card-body">
        <a class="text-dark" href="{{route('info.about_site')}}">このサイトについて</a>
    </div>
</div>
<br>
<div class="card">
    <a class="text-dark" href="{{route('vocalo.recently_famous_vocalovideos')}}"><div class="card-header"><b>最近話題のボカロ曲</b></div></a>
    <div class="card-body">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="display-if-lg-or-more">
                        <div class="row d-none d-lg-flex">
                            @for($i = 0; $i < 3; $i++)
                                <div class="embed-responsive embed-responsive-16by9 carousel-grid col-4">
                                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[$i]->video_id}}"></iframe>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="display-if-under-lg">
                        <div class="row d-xl-none d-block">
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-12">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[0]->video_id}}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="display-if-lg-or-more">
                        <div class="row d-none d-lg-flex">
                            @for($i = 3; $i < 6; $i++)
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-4">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[$i]->video_id}}"></iframe>
                            </div>
                            @endfor
                        </div>
                    </div>
                    <div class="display-if-under-lg">
                        <div class="row d-xl-none d-block">
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-12">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[1]->video_id}}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="display-if-lg-or-more">
                        <div class="row d-none d-lg-flex">
                            @for($i = 6; $i < 9; $i++)
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-4">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[$i]->video_id}}"></iframe>
                            </div>
                            @endfor
                        </div>
                    </div>
                    <div class="display-if-under-lg">
                        <div class="row d-xl-none d-block">
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-12">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_vocalovideos[2]->video_id}}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
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
        <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="display-if-lg-or-more">
                        <div class="row d-none d-lg-flex">
                        @for($i = 0; $i < 3; $i++)
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-4">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_utattemita[$i]->video_id}}"></iframe>
                            </div>
                        @endfor
                        </div>

                    </div>
                    <div class="display-if-under-lg">
                        <div class="row d-xl-none d-block">
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-12">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_utattemita[0]->video_id}}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="display-if-lg-or-more">
                        <div class="row d-none d-lg-flex">
                        @for($i = 3; $i < 6; $i++)
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-4">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_utattemita[$i]->video_id}}"></iframe>
                            </div>
                        @endfor
                        </div>
                    </div>
                    <div class="display-if-under-lg">
                        <div class="row d-xl-none d-block">
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-12">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_utattemita[1]->video_id}}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="display-if-lg-or-more">
                        <div class="row d-none d-lg-flex">
                        @for($i = 6; $i < 9; $i++)
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-4">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_utattemita[$i]->video_id}}"></iframe>
                            </div>
                        @endfor
                        </div>
                    </div>
                    <div class="display-if-under-lg">
                        <div class="row d-xl-none d-block">
                            <div class="embed-responsive embed-responsive-16by9 carousel-grid col-12">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$pickup_utattemita[2]->video_id}}"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
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
@endsection