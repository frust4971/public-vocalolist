<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VocaloGachaController extends Controller
{
    public function index(Request $request){
        $queries = $request->query();
        if(!array_key_exists('page',$queries)){
            $queries['page'] = '1';
        }
        $seed = $request->input('seed',random_int(0,PHP_INT_MAX));
        $queries['seed'] = $seed;
        return view('vocalo.gacha_result',compact('queries'));
    }
}
