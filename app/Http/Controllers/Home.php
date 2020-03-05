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
}
