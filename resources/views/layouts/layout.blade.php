<!doctype html>
<html lang="ja">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3DHJTMDG4X"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-3DHJTMDG4X');
    </script>

    <script data-ad-client="ca-pub-7839225156670574" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="format-detection" content="telephone=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            background-color: #66CCCC;
        }

        .container {
            background-color: aliceblue;
        }

        .content-title{
            overflow-wrap: break-word;
            word-break: break-all;
        }

        .rank{
            position:absolute;
            top:-5px;
            z-index:1;
        }
    </style>
    @yield('title')
    @yield('description')
    @yield('style')
    @yield('meta')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('home')}}"><b>VocaloList</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @yield('page_name')
                @if(!isset($page_name))
                <?php $page_name = NULL ?>
                @endif
                <li class="nav-item {{$page_name == 'home'?'active':NULL}}">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{$page_name == 'vocalo'?'active':NULL}} dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ?????????
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route('vocalo.vocalo_ranking')}}">??????????????????????????????</a>
                        <a class="dropdown-item" href="{{route('vocalo.recently_famous_vocalovideos')}}">????????????????????????</a>
                        <a class="dropdown-item" href="{{route('vocalo.vocalo_gacha')}}">??????????????????</a>
                    </div>
                </li>
                <li class="nav-item {{$page_name == 'utattemita'?'active':NULL}}">
                    <a class="nav-link" href="{{route('utattemita.recently_famous_utattemita')}}">???????????????</a>
                </li>
                <li class="nav-item {{$page_name == 'contact'?'active':NULL}}">
                    <a class="nav-link" href="{{route('contact')}}">??????????????????</a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('breadcrumbs')
    <div class="container mt-3">
        <div id="app">
            @yield('contents')
        </div>
    </div>
    <script src="{{asset('/js/thumbnail-checker.js')}}"></script>
</body>
</html>