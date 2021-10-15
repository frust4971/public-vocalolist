<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RecentlyFamousUtattemitaController extends Controller
{
    public function index(Request $request){
        $page = $request->input('page',1);
        $sort = $request->input('sort',0);
        if($sort == 1){
            $utattemita = DB::table('recently_famous_utattemita')->orderBy('view_count','desc')->orderBy('video_id')->paginate(10);
        }else{
            $utattemita = DB::table('recently_famous_utattemita')->orderBy('published_at','desc')->orderBy('video_id')->paginate(10);
        }
        $newest = DB::table('recently_famous_utattemita')->select('published_at')->orderBy('published_at','desc')->first();
        $newest_date = $newest->published_at;
        $oldest = DB::table('recently_famous_utattemita')->select('published_at')->orderBy('published_at')->first();
        $oldest_date = $oldest->published_at;
        return view('utattemita.recently_famous_utattemita',compact('utattemita','page','sort','newest_date','oldest_date'));
    }

    public function show(Request $request,$id){
        $page = $request->input('page',1);
        $sort = $request->input('sort',0);
        $utattemita_video = DB::table('recently_famous_utattemita')->where('video_id',$id)->first();
        return view('utattemita.recently_famous_utattemita_video',compact('utattemita_video','page','sort'));
    }
}
