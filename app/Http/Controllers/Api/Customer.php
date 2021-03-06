<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\M_Model;
use Illuminate\Support\Facades\Hash;
class Customer extends Controller
{
    //
    public $_model;
    function __construct(){
        $this->_model = new M_Model();
    }
    function getInfo(Request $rq){
        $info = $this->_model->getInfo("customer",$rq->id);
        return response()->json($info);
    }
    function getOrder(Request $rq){
        $order = $this->_model->getListOrder($rq->id);
        return response()->json($order);
    }
    function getOrderDetail(Request $rq){
        $arrProduct = [];
        $order_detail = $this->_model->getOrderDetail($rq->order_id,$rq->customer_id);
        if($order_detail->isEmpty()){
            return response()->json(["err"=>1,"msg"=>"Có lỗi xảy ra! đơn hàng này không tồn tại"]);
        }
        foreach($order_detail as $item){
            $arrProduct[] = $item->id;
        }
        $image = $this->_model->getListImageProduct(array("where_in"=>["product_id"=>$arrProduct],"order"=>['priority'=>'desc']));
        foreach($order_detail as $item){
            $item->img = [];
            foreach($image as $img){
                if($item->id == $img->product_id){
                    array_push($item->img,$img);
                }
            }
        }
        return response()->json(["err"=>0,"product"=>$order_detail]);
    }
    function getInfoShipping(Request $rq){
        return response()->json($this->_model->getInfoShipping($rq->id));
    }
    function addInfoShip(Request $rq){
        $this->_model->addInfoShip($rq);
        return response()->json($rq);
    }
    function addOrder(Request $rq){
        $order = $rq->order;
        $idOrder = $this->_model->addOrder($rq->order);
        $order['id']=$idOrder;
        $orderDetail = [];
        foreach($rq->order_detail as $k=>$it){
            $orderDetail[$k]["order_id"]=$idOrder;
            $orderDetail[$k]["product_id"]=$it['product_id'];
            $orderDetail[$k]["price"]=$it['price'];
            $orderDetail[$k]["qty"]=$it['qty'];
            $orderDetail[$k]["option"]=$it['option'];
        }
        $this->_model->addOrderDetail($orderDetail);
        return response()->json($order);
    }
    function deleteAddress(Request $rq){
        $address =  $this->_model->deleteAddress($rq->id);
        return;
    }
    function updateInfo(Request $rq){
        $data = $rq->customer;
        if($rq->isChangePassword){
            $oldinfo = $this->_model->getInfo("customer",$rq->id);
            if (Hash::check($rq->oldpassword, $oldinfo->password)){
                $data['password'] = Hash::make($rq->password);
            }else{
                return response()->json(["err"=>1,"msg"=>"Mật khẩu không chính xác"]); 

            }
        }
        $this->_model->updateInfo($rq->id,$data);
        $info = $this->_model->getInfo("customer",$rq->id);
        return response()->json(["err"=>0,"info"=>$info]);
    }
}
