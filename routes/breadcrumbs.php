<?php
Breadcrumbs::for('home',function($trail){
    $trail->push('Home',route('home'));
});


Breadcrumbs::for('vocalo.recently_famous_vocalovideos',function($trail){
    $trail->parent('home');
    $trail->push('最近話題のボカロ',route('vocalo.recently_famous_vocalovideos'));
});


Breadcrumbs::for('vocalo.vocalo_ranking',function($trail){
    $trail->parent('home');
    $trail->push('歴代ボカロランキング',route('vocalo.vocalo_ranking'));
});

Breadcrumbs::for('vocalo.vocalo_gacha',function($trail){
    $trail->parent('home');
    $trail->push('ボカロガチャ',route('vocalo.vocalo_gacha'));
});
Breadcrumbs::for('vocalo.gacha_result',function($trail){
    $trail->parent('vocalo.vocalo_gacha');
    $trail->push('ボカロガチャ結果',route('vocalo.gacha_result'));
});
Breadcrumbs::for('vocalo.gacha_result.show',function($trail,$title,$id,$seed,$page){
    $trail->parent('vocalo.gacha_result',$seed,$page);
    $params = ['id' => $id];
    if(isset($seed)) $params['seed'] = $seed;
    if(isset($page)) $params['page'] = $page;
    $trail->push($title,route('vocalo.gacha_result',$params));
});


Breadcrumbs::for('utattemita.recently_famous_utattemita',function($trail){
    $trail->parent('home');
    $trail->push('最近話題の歌ってみた',route('utattemita.recently_famous_utattemita'));
});

Breadcrumbs::for('info.about_site',function($trail){
    $trail->parent('home');
    $trail->push('このサイトについて',route('info.about_site'));
});
Breadcrumbs::for('contact',function($trail){
    $trail->parent('home');
    $trail->push('お問い合わせ',route('contact'));
});
