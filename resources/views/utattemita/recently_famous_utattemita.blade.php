@extends('layouts.layout')
@section('title')
<title>最近話題のボカロ歌ってみた！| VocaloList</title>
@endsection
@section('description')
<meta name="description" content="YouTubeで再生回数10万越えの最近話題になっている歌ってみた動画を集めました。投稿日順やランキング順で見逃している動画がないか確認しよう！好みの歌い手に出会えるかもしれないぞ">
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('utattemita.recently_famous_utattemita')}}
@endsection
@section('contents')
    <div class="row">
        <div class="ml-lg-4 mt-4 col-lg-6">
            <h2>最近話題の歌ってみた</h2>
        </div>
    </div>
    <div class="row">
        <div class="dropdown text-right my-1  ml-lg-3 col-lg-7">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if($sort == 0)
                投稿日順
            @elseif($sort == 1)
                再生回数順
            @endif
            </button>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/utattemita/recently_famous_utattemita">投稿日順</a>
                <a class="dropdown-item" href="/utattemita/recently_famous_utattemita?sort=1">再生回数順</a>
            </div>
        </div>
    </div>
    @for($i = 0;$i < count($utattemita);$i++)
        <div class="content px-2 py-lg-3 py-2">
            <div class="row">
                <h1 class="col-1 text-center"><span class="badge badge-secondary">{{$page > 0?10*($page-1)+$i+1:$i+1}}</span></h1>
                <div class="embed-responsive embed-responsive-16by9 col-lg-6">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$utattemita[$i]->video_id}}"></iframe>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-1 col-0"></div>
                <h2 class="col-lg-6 bg-light py-2 border-left border-primary">{{$utattemita[$i]->title}}</h2>
            </div>
            <div class="row">

                <div class="col-lg-1 col-0"></div>
                <div class="col-lg-6 text-right">{{$utattemita[$i]->published_at}}</div>
            </div>
        </div>
    @endfor
    <?php $queries = array();
        if(htmlspecialchars($sort) != 0 ) $queries['sort'] = htmlspecialchars($sort);
    ?>
    {{$utattemita->appends($queries)->links('vendor.pagination.original_pagination_view')}}
@endsection