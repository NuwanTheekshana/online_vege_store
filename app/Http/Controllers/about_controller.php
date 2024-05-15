<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\shopping_controller;

class about_controller extends Controller
{
    public function add_to_cart_count()
    {
        $controller = new shopping_controller;
        $add_to_cart_count = $controller->add_to_cart_count();
        return $add_to_cart_count;
    }

    public function about_us()
    {
        $add_to_cart_count = $this->add_to_cart_count();
        return view('about.about_us')->with('add_to_cart_count', $add_to_cart_count);
    }

    public function contact_us()
    {
        $add_to_cart_count = $this->add_to_cart_count();
        return view('about.contact_us')->with('add_to_cart_count', $add_to_cart_count);
    }
}
