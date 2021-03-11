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
            $vocalovideos = DB::table('recently_famous_vocalovideos')->orderBy('view_count','desc')->paginate(10);
        }else{
            $vocalovideos = DB::table('recently_famous_vocalovideos')->orderBy('published_at','desc')->paginate(10);
        }
        return view('vocalo.recently_famous_vocalovideos',compact('vocalovideos','page','sort'));
    }
}
