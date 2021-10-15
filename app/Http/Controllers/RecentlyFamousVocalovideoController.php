<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RecentlyFamousVocalovideoController extends Controller
{
    public function index(Request $request){
        $page = $request->input('page',1);
        $sort = $request->input('sort',0);
        if($sort == 1){
            $vocalovideos = DB::table('recently_famous_vocalovideos')->orderBy('view_count','desc')->orderBy('video_id')->paginate(10);
        }else{
            $vocalovideos = DB::table('recently_famous_vocalovideos')->orderBy('published_at','desc')->orderBy('video_id')->paginate(10);
        }
        $newest = DB::table('recently_famous_vocalovideos')->select('published_at')->orderBy('published_at','desc')->first();
        $newest_date = $newest->published_at;
        $oldest = DB::table('recently_famous_vocalovideos')->select('published_at')->orderBy('published_at')->first();
        $oldest_date = $oldest->published_at;
        return view('vocalo.recently_famous_vocalovideos',compact('vocalovideos','page','sort','newest_date','oldest_date'));
    }
    public function show(Request $request,$id){
        $page = $request->input('page',1);
        $sort = $request->input('sort',0);
        $vocalovideo = DB::table('recently_famous_vocalovideos')->where('video_id',$id)->first();
        return view('vocalo.recently_famous_vocalovideo',compact('vocalovideo','page','sort'));
    }
}
