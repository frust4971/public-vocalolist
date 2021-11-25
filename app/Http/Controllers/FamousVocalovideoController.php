<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamousVocalovideoController extends Controller
{
    public function index(Request $request){
        $queries = $request->query();
        if(!array_key_exists('page',$queries)){
            $queries['page'] = '1';
        }
        return view('vocalo.vocalo_ranking',compact('queries'));
    }
}
