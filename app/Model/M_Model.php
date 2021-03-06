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
    function getListOptionFilter(){
        $option['value'] = DB::table('option')
        ->leftJoin('option_value','option.id','=','option_value.option_id')
        ->select(DB::raw("option.id as option_id,option.name as name,option_value.value_id,option_value.value"))
        ->where('option.filter',1)->get();
        $option['option'] = DB::table('option')->where('option.filter',1)->get();
        return $option;
    }
    function getListOption(){
        $option['value'] = DB::table('option')
        ->leftJoin('option_value','option.id','=','option_value.option_id')
        ->select(DB::raw("option.id as option_id,option.name as name,option_value.value_id,option_value.value"))
        ->where('option.filter',1)->get();
        $option['option'] = DB::table('option')->get();
        return $option;
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
            foreach($option['where'] as $k=>$it){
                $table->where($k,$it);
            }
        }
        if(!empty($option['whereIn'])){
            foreach($option['whereIn'] as $k=>$it){
                $table->whereIn($k,$it);
            }
        }
        if(!empty($option['order'])){
            $table->orderBy(key($option['order']),$option['order'][key($option['order'])]);
        }
        if(!empty($option['limit'])){
            $table->limit($option['limit']);
        }
        if(!empty($option['join'])){
            foreach($option['join'] as $join){
                $table->join($join['table'], $join['on1'], '=', $join['on2']);
            }
        }
        if(!empty($option['leftJoin'])){
            foreach($option['leftJoin'] as $join){
                $table->leftJoin($join['table'], $join['on1'], '=', $join['on2']);
            }
        }
        $table = $table
                ->leftJoin('brand', 'product.brand_id', '=', 'brand.id')
                ->leftJoin('category', 'product.category_id', '=', 'category.id')
                ->select(DB::raw("product.id, product.name, sku, product.route,product.category_id , product.brand_id, brand.name as brand_name,brand.route as brand_route,category.route as category_route,category.name as category_name,price"));
        if(!empty($option['paginate'])){
            return $table->paginate($option['paginate']);
        }else{
            return $table->get();
        }
                
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
    function getListProductInGroup($id){
        $table = DB::table("group_detail")->where("group_id",$id)->get();
        $arr = [];
        foreach($table as $it){
            $arr[] = $it->product_id;
        }
        return $arr;
    }
    function getListOptionProduct($id){
        $table = DB::table("option_product")
                    ->where('option_product.product_id',$id)->get();
        $getListOption = $this->getListOption();
        foreach($table as $it){
            foreach($getListOption['value'] as $it2){
                if($it->option_id == $it2->option_id && $it->option_value == $it2->value_id){
                    $arr['value'][] = $it2;
                    $arr['option'][$it2->option_id]=$it2->name;
                }
            }
        }
        return $arr;
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
    function getListOrder($id){
        return DB::table("order")->where("customer_id",$id)->orderBy("created_at","desc")->get();
    }
    function getOrderDetail($order_id,$customer_id){
        return DB::table("order_detail")
        ->join('order', 'order.id', '=', 'order_detail.order_id')
        ->join('product', 'product.id', '=', 'order_detail.product_id')
        ->join('brand', 'product.brand_id', '=', 'brand.id')
        ->join('category', 'product.category_id', '=', 'category.id')
        ->where(["order_id"=>$order_id,"customer_id"=>$customer_id])
        ->select(DB::raw("product.id, product.name,product.price, sku, product.route, brand.name as brand_name,product.category_id , product.brand_id,brand.route as brand_route,category.route as category_route,category.name as category_name,order_detail.price as order_price,order_detail.option as order_option,order_detail.qty as order_qty"))
        ->get();
    }
    function getInfo($table,$id){
        return DB::table($table)->where("id",$id)->first();
    }
    function isExistEmailCustomer($email){
        $table = DB::table("customer")->where("email",$email)->first();
        if($table){
            return true;
        }else{
            return false;
        }
    }
    function getInfoShipping($customer){
        $tableInfo = DB::table("customer")->where("id",$customer)->first();
        $tableShipping = DB::table("ship")->where("customer_id",$customer)->orderBy("id","desc")->get();
        $tableProvince = DB::table("province")->get();
        return array("customer"=>$tableInfo,"ship"=>$tableShipping,"province"=>$tableProvince);
    }
    function addInfoShip($ship){
        return DB::table("ship")->insert([
            "name" => $ship->name,
            "customer_id" => $ship->customer_id,
            "phone" => $ship->phone,
            "address" => $ship->address,
            "state" => $ship->province,
        ]);
    }
    function addOrder($order){
        return DB::table("order")->insertGetId([
            "customer_id" => $order['customer_id'],
            "ship_id"     => $order['ship_id'],
            "total"     => $order['total'],
        ]);
    }
    function addOrderDetail($order_detail){
        return DB::table("order_detail")->insert($order_detail);
    }
    function deleteAddress($id){
        return DB::table("ship")->where('id',$id)->delete();
    }
    function loadListProvince(){
        $tableProvince = DB::table("province")->get();
        return $tableProvince;
    }
    function updateInfo($id,$data){
        return DB::table('customer')
              ->where('id',$id)
              ->update($data);
    }
}
