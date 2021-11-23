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
        
        $page = $request->input('page',1);
        $sort = $request->input('sort',0);
        $table = DB::table($table_name);
        if($sort == 1){
            $videos = $table->orderBy('view_count','desc')->orderBy('video_id')->paginate(10);
        }else{
            $videos = $table->orderBy('published_at','desc')->orderBy('video_id')->paginate(10);
        }
        return $videos;
    }
    private function table_exists($table_name){
        $tables = config('const.VIDEO_TABLES');
        return in_array($table_name,$tables);
    }
}
