<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamousVocalovideoController extends Controller
{
    public function index(Request $request){
        $year = $request->input('year',0);
        $page = $request->input('page',1);
        if($year == 0){
            $vocalovideos = DB::table('famous_vocalovideos')->orderBy('view_count','desc')->paginate(10);
        }else{
            $vocalovideos = DB::table('famous_vocalovideos')->whereYear('published_at',$year)->orderBy('view_count','desc')->paginate(10);
        }
        
        return view('vocalo.vocalo_ranking',compact('vocalovideos','year','page'));
    }
}
