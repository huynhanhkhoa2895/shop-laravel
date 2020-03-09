<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class M_Model extends Model
{
    //
    function getListHeader(){
        $category = DB::table('category')->where("include_menu",1)->select(DB::raw("id, name, route, 'category' as table_name"));
        $brand = DB::table('brand')->where("include_menu",1)->select(DB::raw("id, name, route, 'brand' as table_name"));
        $group = DB::table('group')->where("include_menu",1)->union($category)->union($brand)->select(DB::raw("id, name, route, 'group' as table_name"))->get();
        return $group;
    }
    function getListById($table="category",$id){
        if($table == "category" || $table == "brand")
            return DB::table("product")->where($table."_id",$id)->get();
        else 
            return DB::table("product")->join('group_detail', 'group_detail.product_id', '=', 'product.id')->where("group_detail.group_id",$id)->get();
    }
    function getIdByRoute($url){
        return DB::table('url_rewrite')->where("url",$url)->first();
    }
}
