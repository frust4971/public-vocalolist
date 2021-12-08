<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VocaloGachaController extends Controller
{
    public function index(Request $request){
        $page = $request->input('page',1);
        $seed = $request->input('seed',random_int(0,PHP_INT_MAX));
        $vocalovideos = DB::table('famous_vocalovideos')->inRandomOrder($seed)->paginate(10);
        return view('vocalo.gacha_result',compact('vocalovideos','page','seed'));
    }
    public function show($id){
        $vocalovideo = DB::table('famous_vocalovideos')->where('video_id',$id)->first();
        return view('vocalo.gacha_result_video',compact('vocalovideo'));
    }
}
