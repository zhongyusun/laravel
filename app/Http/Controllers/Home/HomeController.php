<?php

namespace App\Http\Controllers\Home;



use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        //dd(111);
        return view('home.home');
    }
}
