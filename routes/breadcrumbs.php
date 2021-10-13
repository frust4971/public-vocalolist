<?php
Breadcrumbs::for('home',function($trail){
    $trail->push('Home',route('home'));
});


Breadcrumbs::for('vocalo.recently_famous_vocalovideos',function($trail,$page,$sort){
    $trail->parent('home');
    $params = [];
    if(isset($page)) $params['page'] = $page;
    if(isset($sort)) $params['sort'] = $sort;
    $trail->push('最近話題のボカロ',route('vocalo.recently_famous_vocalovideos',$params));
});
Breadcrumbs::for('vocalo.recently_famous_vocalovideos.show',function($trail,$title,$id,$page,$sort){
    $trail->parent('vocalo.recently_famous_vocalovideos',$page,$sort);
    $params = ['id' => $id];
    if(isset($page)) $params['page'] = $page;
    if(isset($sort)) $params['sort'] = $sort;
    $trail->push($title,route('vocalo.recently_famous_vocalovideos.show',$params));
});


Breadcrumbs::for('vocalo.vocalo_ranking',function($trail,$page,$year){
    $trail->parent('home');
    $params = [];
    if(isset($page)) $params['page'] = $page;
    if(isset($year)) $params['year'] = $year;
    $trail->push('歴代ボカロランキング',route('vocalo.vocalo_ranking',$params));
});
Breadcrumbs::for('vocalo.vocalo_ranking.show',function($trail,$title,$id,$page,$year){
    $trail->parent('vocalo.vocalo_ranking',$page,$year);
    $params = ['id' => $id];
    if(isset($page)) $params['page'] = $page;
    if(isset($year)) $params['year'] = $year;
    $trail->push($title,route('vocalo.vocalo_ranking.show',$params));
});

Breadcrumbs::for('vocalo.vocalo_gacha',function($trail){
    $trail->parent('home');
    $trail->push('ボカロガチャ',route('vocalo.vocalo_gacha'));
});
Breadcrumbs::for('vocalo.gacha_result',function($trail,$seed,$page){
    $trail->parent('vocalo.vocalo_gacha');
    $params = [];
    if(isset($seed)) $params['seed'] = $seed;
    if(isset($page)) $params['page'] = $page;
    $trail->push('ボカロガチャ結果',route('vocalo.gacha_result',$params));
});
Breadcrumbs::for('vocalo.gacha_result.show',function($trail,$title,$id,$seed,$page){
    $trail->parent('vocalo.gacha_result',$seed,$page);
    $params = ['id' => $id];
    if(isset($seed)) $params['seed'] = $seed;
    if(isset($page)) $params['page'] = $page;
    $trail->push($title,route('vocalo.gacha_result',$params));
});


Breadcrumbs::for('utattemita.recently_famous_utattemita',function($trail,$page,$sort){
    $trail->parent('home');
    $params = [];
    if(isset($page)) $params['page'] = $page;
    if(isset($sort)) $params['sort'] = $sort;
    $trail->push('最近話題の歌ってみた',route('utattemita.recently_famous_utattemita',$params));
});
Breadcrumbs::for('utattemita.recently_famous_utattemita.show',function($trail,$title,$id,$page,$sort){
    $trail->parent('utattemita.recently_famous_utattemita',$page,$sort);
    $params = ['id' => $id];
    if(isset($page)) $params['page'] = $page;
    if(isset($sort)) $params['sort'] = $sort;
    $trail->push($title,route('utattemita.recently_famous_utattemita.show',$params));
});

Breadcrumbs::for('info.about_site',function($trail){
    $trail->parent('home');
    $trail->push('このサイトについて',route('info.about_site'));
});
Breadcrumbs::for('contact',function($trail){
    $trail->parent('home');
    $trail->push('お問い合わせ',route('contact'));
});
