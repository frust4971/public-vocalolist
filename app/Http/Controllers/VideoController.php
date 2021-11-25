<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VideoController extends Controller
{
    public function show(Request $request){
        $table_name = $request->input('table_name');
        if(is_null($table_name)){
            return null;
        }
        if(!$this->table_exists($table_name)){
            return null;
        }
        $year = $request->input('year',0);
        $sort = $request->input('sort',0);
        $seed = $request->input('seed',null);
        $vocaloid = $request->input('vocaloid',null);
        $query = DB::table($table_name)->select('*');
        if(!is_null($seed)){
            $query = $query->inRandomOrder($seed);
        }
        if($sort == 1){
            $query = $query->orderBy('view_count','desc')->orderBy('video_id');
        }else{
            $query = $query->orderBy('published_at','desc')->orderBy('video_id');
        }
        if($year == 0){
            $query = $query->orderBy('view_count','desc')->orderBy('video_id');
        }else{
            $query = $query->whereYear('published_at',$year)->orderBy('view_count','desc')->orderBy('video_id');
        }
        if(!is_null($vocaloid)){
            $query = $query->where('title','LIKE',"%$vocaloid%");
        }
        $videos = $query->paginate(10);
        return $videos;
    }
    private function table_exists($table_name){
        $tables = config('const.VIDEO_TABLES');
        return in_array($table_name,$tables);
    }
}
