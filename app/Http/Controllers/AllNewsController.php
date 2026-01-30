<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllNewsController extends Controller
{
    public function climateNews(){
        return view('frontend.allnews.climateNews');
    }
}
