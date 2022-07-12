<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyExampleController extends Controller
{
    //ミドルウェアの割り当て
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('log')->only('index');
        $this->middleware('subscribed')->except('store');
    }    
}
