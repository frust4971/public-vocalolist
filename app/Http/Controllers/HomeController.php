<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){ 
        $pickup_vocalovideos = DB::table('recently_famous_vocalovideos')->orderBy('published_at','desc')->limit(9)->get();
        $pickup_utattemita = DB::table('recently_famous_utattemita')->orderBy('published_at','desc')->limit(9)->get();
        return view('home',compact('pickup_vocalovideos','pickup_utattemita'));
    }
}
