<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamousVocalovideoController extends Controller
{
    public function index(Request $request){
        $page = $request->input('page',1);
        $vocalovideos = DB::table('famous_vocalovideos')->orderBy('view_count','desc')->paginate(10);
        return view('vocalo.vocalo_ranking',compact('vocalovideos','page'));
    }
}
