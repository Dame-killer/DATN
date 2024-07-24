<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RevenuesExport;

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
                ->whereMonth('orders.updated_date', $month)
                ->whereYear('orders.updated_date', $year)
                ->where('orders.status', 3)
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
            ->whereMonth('orders.updated_date', $currentMonth)
            ->where('orders.status', 3)
            ->sum(DB::raw('order_details.unit_price * order_details.amount'));

        // Total monthly revenue for the last month
        $lastMonthRevenue = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.updated_date', $lastMonth)
            ->where('orders.status', 3)
            ->sum(DB::raw('order_details.unit_price * order_details.amount'));

        // Total number of sold products in the current month
        $totalSoldProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.updated_date', $currentMonth)
            ->where('orders.status', 3)
            ->sum('order_details.amount');

        // Total number of sold products in the last month
        $lastMonthSoldProducts = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->whereMonth('orders.updated_date', $lastMonth)
            ->where('orders.status', 3)
            ->sum('order_details.amount');

        // Total number of completed orders in the current month
        $completedOrders = DB::table('orders')
            ->whereMonth('updated_date', $currentMonth)
            ->where('status', 3)
            ->count();

        // Total number of completed orders in the last month
        $lastMonthCompletedOrders = DB::table('orders')
            ->whereMonth('updated_date', $lastMonth)
            ->where('status', 3)
            ->count();

        // Total number of canceled orders in the current month
        $canceledOrders = DB::table('orders')
            ->whereMonth('updated_date', $currentMonth)
            ->where('status', 4)
            ->count();

        // Total number of canceled orders in the last month
        $lastMonthCanceledOrders = DB::table('orders')
            ->whereMonth('updated_date', $lastMonth)
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

    public function exportRevenueReport()
    {
        $revenues = [];

        $months = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->month;
            $year = Carbon::now()->subMonths($i)->year;
            $revenue = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->whereMonth('orders.updated_date', $month)
                ->whereYear('orders.updated_date', $year)
                ->where('orders.status', 3)
                ->sum(DB::raw('order_details.unit_price * order_details.amount'));
            $totalSoldProducts = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->whereMonth('orders.updated_date', $month)
                ->whereYear('orders.updated_date', $year)
                ->where('orders.status', 3)
                ->sum('order_details.amount');
            $completedOrders = DB::table('orders')
                ->whereMonth('updated_date', $month)
                ->whereYear('updated_date', $year)
                ->where('status', 3)
                ->count();
            $canceledOrders = DB::table('orders')
                ->whereMonth('updated_date', $month)
                ->whereYear('updated_date', $year)
                ->where('status', 4)
                ->count();

            $revenues[] = [
                'month' => $months[$month - 1] . ' ' . $year,
                'revenue' => $revenue,
                'sold_products' => $totalSoldProducts,
                'completed_orders' => $completedOrders,
                'canceled_orders' => $canceledOrders,
            ];
        }

        return Excel::download(new RevenuesExport($revenues), 'revenue_report.xlsx');
    }

    public function homeCustomer()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();


        // Trả về view với các biến dữ liệu được compact lại
        return view('customer.home', compact('products', 'categories', 'brands'));
    }

    public function acount()
    {
        return redirect()->route('acount');
    }



    public function setFlashMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'type' => 'required|string|in:success,error',
        ]);

        session()->flash($request->type, $request->message);

        return response()->json(['status' => 'Message set'], 200);
    }
}
