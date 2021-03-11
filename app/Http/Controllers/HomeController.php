<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){ 
        //1日の秒数
        $ttl=86400;
        if(Cache::has('pickup_vocalovideos_cache')){
            $pickup_vocalovideos = Cache::get('pickup_vocalovideos_cache');
        }else{
            $pickup_vocalovideos = DB::table('recently_famous_vocalovideos')->orderBy('published_at','desc')->limit(9)->get();
            Cache::put('pickup_vocalovideos_cache',$pickup_vocalovideos,$ttl);
        }
        if(Cache::has('pickup_utattemita')){
            $pickup_utattemita = Cache::get('pickup_utattemita');
        }else{
            $pickup_utattemita = DB::table('recently_famous_utattemita')->orderBy('published_at','desc')->limit(9)->get();
            Cache::put('pickup_vocalovideos_cache',$pickup_vocalovideos,$ttl);
        }

        return view('home',compact('pickup_vocalovideos','pickup_utattemita'));
    }
}
