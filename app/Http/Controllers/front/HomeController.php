<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function home()
    {
        return view('front.index');
        
    }
    public function aboutUs()
    {
        return view('front.about-us');
        
    }
    public function contactUs()
    {
        return view('front.contact-us');
        
    }
    public function service()
    {
        return view('front.service');
        
    }

    public function login()
    {
        return view('front.login');
    }
}
