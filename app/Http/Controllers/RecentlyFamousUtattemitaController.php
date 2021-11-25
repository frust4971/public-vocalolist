<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RecentlyFamousUtattemitaController extends Controller
{
    public function index(Request $request){
        $queries = $request->query();
        if(!array_key_exists('page',$queries)){
            $queries['page'] = '1';
        }
        $newest = DB::table('recently_famous_utattemita')->select('published_at')->orderBy('published_at','desc')->first();
        $newest_date = $newest->published_at;
        $oldest = DB::table('recently_famous_utattemita')->select('published_at')->orderBy('published_at')->first();
        $oldest_date = $oldest->published_at;
        return view('utattemita.recently_famous_utattemita',compact('queries','newest_date','oldest_date'));
    }
}
