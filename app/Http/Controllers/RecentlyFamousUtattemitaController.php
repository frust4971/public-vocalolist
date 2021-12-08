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
            $utattemita = DB::table('recently_famous_utattemita')->orderBy('view_count','desc')->paginate(10);
        }else{
            $utattemita = DB::table('recently_famous_utattemita')->orderBy('published_at','desc')->paginate(10);
        }
        return view('utattemita.recently_famous_utattemita',compact('utattemita','page','sort'));
    }

    public function show($id){
        $utattemita_video = DB::table('recently_famous_utattemita')->where('video_id',$id)->first();
        return view('utattemita.recently_famous_utattemita_video',compact('utattemita_video'));
    }
}
