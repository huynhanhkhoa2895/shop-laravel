<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Model\M_Model;
class Home extends Controller
{
    public $_model;
    function __construct(){
        $this->_model = new M_Model();
    }
    function index(){
        return view("admin/pages/home");
    }
    public function test(){
    }
    
}
