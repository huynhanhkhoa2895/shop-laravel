<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class M_Model extends Model
{
    //
    function getListHeader(){
        $category = DB::table('category')->where("include_menu",1)->select(DB::raw("id, name, route, 'category' as table_name"));
        $group = DB::table('group')->where("include_menu",1)->union($category)->select(DB::raw("id, name, route, 'group' as table_name"))->get();
        return $group;
    }
}
