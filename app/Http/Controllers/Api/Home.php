<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $arr =[
            ['option_id' => 1,'option_value' => 2,'option_product' => 3],
            ['option_id' => 1,'option_value' => 2,'option_product' => 3],
            ['option_id' => 5,'option_value' => 2,'option_product' => 3],
            ['option_id' => 2,'option_value' => 3,'option_product' => 3],
        ];
        dump(array_unique($arr));

    }
    public function getListMenu(){
        return response()->json($this->_model->getListHeader());
    }
    public function getListOptionFilter(){
        return response()->json($this->_model->getListOptionFilter());
    }
    public function getCategory(Request $rq){
        $route = $this->_model->getIdByRoute($rq->route);
        $info = $this->_model->getInfo($route->table,$route->origin);
        return response()->json(["info"=>$info,"table"=>$route->table]);
    }
    public function getListProduct(Request $rq){
        // $route = $this->_model->getIdByRoute($rq->route);
        // $info = $this->_model->getInfo($route->table,$route->origin);
        $arrProduct = [];
        $con = [];
        $option = $rq->query("option");
        if(!empty($option['route'])){
            if($option['route']['table'] == "group"){
                $list_product = $this->_model->getListProductInGroup($option['route']['id']);
                if(empty($option['whereIn'])){
                    $option['whereIn']=['product.id'=>$list_product];
                }else{
                    $option['whereIn']=array_merge($option['whereIn'],['product.id'=>$list_product]);
                }
            }else{
                if(empty($option['where'])){
                    $option['where']=["product.".$option['route']['table'].'_id'=>$option['route']['id']];
                }else{
                    $option['where']=array_merge($option['where'],["product.".$option['route']['table'].'_id'=>$option['route']['id']]);
                }
            }
        }

        $product = $this->_model->getListProduct($option);
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
        $option_product = $this->_model->getListOptionProduct($product->id);
        return response()->json(['product'=>$product,'image'=>$image,'option_product'=>$option_product]);
    }
}

