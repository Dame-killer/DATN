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

        $cart = session()->get('cart', []); // Lấy nội dung giỏ hàng từ session

        $order_details = [];

        $totalPrice = 0;

        foreach ($cart as $item) {
            // Tạo một đối tượng OrderDetail tạm thời để hiển thị trên view
            $order_detail = new \stdClass();
            $order_detail->product_detail = new \stdClass();
            $order_detail->product_detail->product = new \stdClass();
            $order_detail->product_detail->color = new \stdClass();
            $order_detail->product_detail->size = new \stdClass();

            $order_detail->product_detail->id = $item['id'];
            $order_detail->product_detail->product->code = $item['attributes']['product_code'];
            $order_detail->product_detail->product->name = $item['name'];
            $order_detail->product_detail->product->image = $item['attributes']['product_image'];
            $order_detail->amount = $item['quantity'];
            $order_detail->unit_price = $item['attributes']['product_price'];
            $order_detail->product_detail->size->size_name = $item['attributes']['size_name'];
            $order_detail->product_detail->size->size_number = $item['attributes']['size_number'];
            $order_detail->product_detail->color->name = $item['attributes']['color_name'];
            $order_detail->product_detail->color->code = $item['attributes']['color_code'];
            $order_detail->totalPricePerProduct = $order_detail->unit_price * $order_detail->amount;

            $order_details[] = $order_detail;
            $totalPrice += $order_detail->totalPricePerProduct;
        }

        return view('customer.home')->with(compact('products', 'categories', 'brands', 'order_details', 'totalPrice'));
    }
    public function acount()
    {
        return redirect()->route('acount');
    }
}
