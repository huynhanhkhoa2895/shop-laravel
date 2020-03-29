<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Factory\Cart;
use App\Model\M_Model;
use Illuminate\Support\Facades\Auth;
class Verify extends Controller
{
    //
    function __construct(){
        $this->_model = new M_Model();
    }
    function login(Request $rq){
        $credentials = $rq->only('email', 'password');
        // if (Auth::guard('api')->attempt($credentials)) {
        //     // Authentication passed...
        //     return Auth::user();;
        // }
        return response()->json(["name"=>"123456","rq"=>$rq->email]);
    }
}
