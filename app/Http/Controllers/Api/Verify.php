<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Factory\Cart;
use App\Model\M_Model;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
class Verify extends Controller
{
    //
    function __construct(){
        $this->_model = new M_Model();
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');        
        if (!($token = JWTAuth::attempt($credentials))) {
            return response()->json([
                'status' => 0,
                'error' => 'invalid.credentials',
                'msg' => ['Email hoặc mật khẩu không chính xác']
            ]);
        }
        return response()->json(['status' => 1,'token' => $token,'user'=>JWTAuth::User()], Response::HTTP_OK);
    }
    public function register(Request $request){
        if($this->_model->isExistEmailCustomer($request->email)){
            return response()->json([
                'status' => 0,
                'error' => 'invalid.credentials',
                'msg' => ['Email đã tồn tại']
            ], 200);
        }else{
            $user = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => bcrypt($request->password)
            ]);
            if($user){
                $credentials = $request->only('email', 'password');        
                if (!($token = JWTAuth::attempt($credentials))) {
                    return response()->json([
                        'status' => 0,
                        'error' => 'invalid.credentials',
                        'msg' => ['Email hoặc mật khẩu không chính xác']
                    ]);
                }
                return response()->json(['status' => 1,'token' => $token,'user'=>JWTAuth::User()], Response::HTTP_OK);
            } 
            return response()->json([
                'status' => 0,
                'error' => 'invalid.credentials',
                'msg' => ['Lỗi không xác định']
            ], 200);
        }

        
    }
    public function details()
    {
        return response()->json(['user' => auth()->customer()], 200);
    }
    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
}
