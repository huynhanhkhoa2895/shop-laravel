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
    function getListProduct($option = []){
        $table = DB::table("product");
        if(!empty($option['where'])){
            $table->where(key($option['where']),$option['where'][key($option['where'])]);
        }
        if(!empty($option['order'])){
            $table->orderBy(key($option['order']),$option['order'][key($option['order'])]);
        }
        if(!empty($option['limit'])){
            $table->limit($option['limit']);
        }
        return $table
                ->leftJoin('brand', 'product.brand_id', '=', 'brand.id')
                ->leftJoin('category', 'product.category_id', '=', 'category.id')
                ->select(DB::raw("product.id, product.name, sku, product.route,product.category_id , product.brand_id, brand.name as brand_name,brand.route as brand_route,category.route as category_route,category.name as category_name,price"))
                ->get();
    }
    function getListImageProduct($option = []){
        $table = DB::table("image");
        if(!empty($option['where'])){
            $table->where(key($option['where']),$option['where'][key($option['where'])]);
        }
        if(!empty($option['where_in'])){
            $table->whereIn(key($option['where_in']),$option['where_in'][key($option['where_in'])]);
        }
        return $table->get();
    }
    function getProduct($id){
        $table = DB::table("product");
        return $table
                ->where("product.id",$id)
                ->leftJoin('brand', 'product.brand_id', '=', 'brand.id')
                ->leftJoin('category', 'product.category_id', '=', 'category.id')
                ->select(DB::raw("product.id, product.name, sku, product.route, brand.name as brand_name,product.category_id , product.brand_id,brand.route as brand_route,category.route as category_route,category.name as category_name,price"))
                ->first();
    }
}
