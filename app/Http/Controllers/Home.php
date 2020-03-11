<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Factory\Cart;
use App\Model\M_Model;
class Home extends Controller
{
    public $_model;
    function __construct(){
        $this->_model = new M_Model();
    }
    public function test(){
        $cart = new Cart(1,2);
        echo "<pre>";
        print_r($cart->getCart(1));
        echo "</pre>";
    }
    public function getListMenu(){
        return response()->json($this->_model->getListHeader());
    }
    public function getCategory(Request $rq){
        $route = $this->_model->getIdByRoute($rq->route);
        if($route->table == "category" || $route->table == "brand"){
            $product = $this->_model->getListById($route->table,$route->origin);
        }else{
            $product = $this->_model->getListById($route->table,$route->origin);
        }
        return response()->json($product);
    }
    public function getListProduct(Request $rq){
        $arrProduct = [];
        $con = [];
        $product = $this->_model->getListProduct(array("limit"=>6,"order"=>['product.created_at'=>'desc']));
        foreach($product as $item){
            $arrProduct[] = $item->id;
        }
        $image = $this->_model->getListImageProduct(array("where_in"=>["product_id"=>$arrProduct],"order"=>['priority'=>'desc']));
        return response()->json(['product'=>$product,'image'=>$image]);
    }
    public function getDetailProduct(Request $rq){ 
        $route = $this->_model->getIdByRoute($rq->route);
        if(empty($route)){
            return response()->json(['product'=>[],'image'=>[]]);
        }
        $product = $this->_model->getProduct($route->origin);
        $image = $this->_model->getListImageProduct(array("where"=>["product_id"=>$product->id],"order"=>['priority'=>'desc']));
        return response()->json(['product'=>$product,'image'=>$image]);
    }
}
