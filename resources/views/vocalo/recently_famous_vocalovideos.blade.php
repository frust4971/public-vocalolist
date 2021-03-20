@extends('layouts.layout')
@section('title')
<title>最近話題のボカロ|VocaloList</title>
@endsection
@section('description')
<meta name="description" content="YouTubeで再生回数10万越えの最近話題になっているボカロ曲を集めました。投稿日順やランキング順で見逃している曲がないか確認しよう！まだ見ぬ有名ボカロPに出会えるかもしれないぞ">
@endsection
@section('breadcrumbs')
{{Breadcrumbs::render('vocalo.recently_famous_vocalovideos')}}
@endsection
@section('contents')
    <div class="row">
        <div class="ml-4 mt-2">
            <h2>最近話題のボカロ</h2>
        </div>
        <div class="dropdown ml-auto mr-2 mt-3">
            <button class="btn btn-secondary dropdown-toggle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            @if($sort == 0)
                投稿日順
            @elseif($sort == 1)
                再生回数順
            @endif
            </button>
            
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="/vocalo/recently_famous_vocalovideos">投稿日順</a>
                <a class="dropdown-item" href="/vocalo/recently_famous_vocalovideos?sort=1">再生回数順</a>
            </div>
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
                <h2 class="col-lg-6 bg-light py-2 border-left border-primary">{{$vocalovideos[$i]->title}}</h2>
            </div>
            <div class="row">

                <div class="col-lg-1 col-0"></div>
                <div class="col-lg-6 text-right">{{$vocalovideos[$i]->published_at}}</div>
            </div>
        </div>
    @endfor
    <?php $queries = array();
        $sort == 0 ? : $queries['sort'] = htmlspecialchars($sort);
    ?>
    {{$vocalovideos->appends($queries)->links('vendor.pagination.original_pagination_view')}}
@endsection