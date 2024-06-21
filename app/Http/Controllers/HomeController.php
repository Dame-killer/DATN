<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexCustomer()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();

        return view('customer.home')->with(compact('products', 'categories', 'brands'));
    }
    public function acount()
    {
        return redirect()->route('acount');
    }
}
