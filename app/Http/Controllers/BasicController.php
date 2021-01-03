<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicController extends Controller
{
    // Get Request on Home Page
    public function getHome(){
        return view('basic.index');
    }

    // Get Request on Contact Page
    public function getContact(){
        return view('basic.contact');
    }

}
