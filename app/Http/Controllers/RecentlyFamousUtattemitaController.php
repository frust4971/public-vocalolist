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
            $vocalovideos = DB::table('recently_famous_utattemita')->orderBy('view_count','desc')->paginate(10);
        }else{
            $vocalovideos = DB::table('recently_famous_utattemita')->orderBy('published_at')->paginate(10);
        }
        return view('utattemita.recently_famous_utattemita',compact('vocalovideos','page','sort'));
    }
}
