<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function home(){
        return view('learn');
    }
}
