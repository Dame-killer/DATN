<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function dashboard()
    {
        $revenues = [];

        $months = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->month;
            $year = Carbon::now()->subMonths($i)->year;
            $revenue = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->whereMonth('orders.order_date', $month)
                ->whereYear('orders.order_date', $year)
                ->sum(DB::raw('order_details.unit_price * order_details.amount'));
            $revenues[] = [
                'month' => $months[$month - 1] . ' ' . $year,
                'revenue' => $revenue
            ];
        }

        $currentMonth = Carbon::now()->month;
        $lastMonth = Carbon::now()->subMonth()->month;

        // Total monthly revenue for the current month
        $totalRevenue = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.order_date', $currentMonth)
            ->sum(DB::raw('order_details.unit_price * order_details.amount'));

        // Total monthly revenue for the last month
        $lastMonthRevenue = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.order_date', $lastMonth)
            ->sum(DB::raw('order_details.unit_price * order_details.amount'));

        // Total number of sold products in the current month
        $totalSoldProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.order_date', $currentMonth)
            ->sum('order_details.amount');

        // Total number of sold products in the last month
        $lastMonthSoldProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.order_date', $lastMonth)
            ->sum('order_details.amount');

        // Total number of completed orders in the current month
        $completedOrders = DB::table('orders')
            ->whereMonth('order_date', $currentMonth)
            ->where('status', 3)
            ->count();

        // Total number of completed orders in the last month
        $lastMonthCompletedOrders = DB::table('orders')
            ->whereMonth('order_date', $lastMonth)
            ->where('status', 3)
            ->count();

        // Total number of canceled orders in the current month
        $canceledOrders = DB::table('orders')
            ->whereMonth('order_date', $currentMonth)
            ->where('status', 4)
            ->count();

        // Total number of canceled orders in the last month
        $lastMonthCanceledOrders = DB::table('orders')
            ->whereMonth('order_date', $lastMonth)
            ->where('status', 4)
            ->count();

        // Calculate percentage changes
        $revenueChange = $lastMonthRevenue ? (($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100 : 0;
        $soldProductsChange = $lastMonthSoldProducts ? (($totalSoldProducts - $lastMonthSoldProducts) / $lastMonthSoldProducts) * 100 : 0;
        $completedOrdersChange = $lastMonthCompletedOrders ? (($completedOrders - $lastMonthCompletedOrders) / $lastMonthCompletedOrders) * 100 : 0;
        $canceledOrdersChange = $lastMonthCanceledOrders ? (($canceledOrders - $lastMonthCanceledOrders) / $lastMonthCanceledOrders) * 100 : 0;

        return view('admin.home', compact('revenues', 'totalRevenue', 'totalSoldProducts', 'completedOrders', 'canceledOrders',
            'revenueChange', 'soldProductsChange', 'completedOrdersChange', 'canceledOrdersChange'));
    }

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
