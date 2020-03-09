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
}
