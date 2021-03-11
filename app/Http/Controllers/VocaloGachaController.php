<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VocaloGachaController extends Controller
{
    public function index(Request $request){
        $page = $request->input('page',1);
        $vocalovideos = DB::table('famous_vocalovideos')->inRandomOrder()->paginate(10);
        return view('vocalo.gacha_result',compact('vocalovideos','page'));
    }
}
