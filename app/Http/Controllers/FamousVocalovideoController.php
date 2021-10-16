<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamousVocalovideoController extends Controller
{
    public function index(Request $request){
        $year = $request->input('year',0);
        $page = $request->input('page',1);
        $vocaloid = $request->input('vocaloid');
        if($year == 0){
            if(is_null($vocaloid)){
                $vocalovideos = DB::table('famous_vocalovideos')->orderBy('view_count','desc')->orderBy('video_id')->paginate(10);
            }else{
                $vocalovideos = DB::table('famous_vocalovideos')->where('title','LIKE',"%$vocaloid%")->orderBy('view_count','desc')->orderBy('video_id')->paginate(10);
            }
        }else{
            if(is_null($vocaloid)){
                $vocalovideos = DB::table('famous_vocalovideos')->whereYear('published_at',$year)->orderBy('view_count','desc')->orderBy('video_id')->paginate(10);
            }else{
                $vocalovideos = DB::table('famous_vocalovideos')->where('title','LIKE',"%$vocaloid%")->whereYear('published_at',$year)->orderBy('view_count','desc')->orderBy('video_id')->paginate(10);
            }
        }
        return view('vocalo.vocalo_ranking',compact('vocalovideos','page','year','vocaloid'));
    }
    public function show(Request $request,$id){
        $year = $request->input('year',0);
        $page = $request->input('page',1);
        $vocaloid = $request->input('vocaloid');
        $vocalovideo = DB::table('famous_vocalovideos')->where('video_id',$id)->first();
        return view('vocalo.vocalo_ranking_video',compact('vocalovideo','page','year','vocaloid'));
    }
}
