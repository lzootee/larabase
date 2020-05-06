<?php

namespace App\Http\Controllers\Web;


use Illuminate\Http\Request;

class HomeController
{
    public function index(Request $request) {
        return view('index');
    }
}