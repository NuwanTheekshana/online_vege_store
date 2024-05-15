<?php

namespace App\Http\Controllers;

use App\Http\Controllers\shopping_controller;
use Illuminate\Http\Request;
use App\Models\product_tbl;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function add_to_cart_count()
    {
        $controller = new shopping_controller;
        $add_to_cart_count = $controller->add_to_cart_count();
        return $add_to_cart_count;
    }

    public function index()
    {
        $add_to_cart_count = $this->add_to_cart_count();
        $products = product_tbl::where('Status', '1')->orderBy('Product_id', 'DESC')->get();
        return view('home')->with('products', $products)->with('add_to_cart_count', $add_to_cart_count);
    }
}
