<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Verify extends Controller
{
    function index(){
        return view("login");
    }
}
