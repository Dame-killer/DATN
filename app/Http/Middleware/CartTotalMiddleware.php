<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\OrderDetail;

class CartTotalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $totalOrders = 0;

        // Lấy tổng số lượng đơn hàng từ session
        $sessionCart = session()->get('cart', []);
        foreach ($sessionCart as $details) {
            $totalOrders += $details['quantity'];
        }

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

        View::share('totalOrders', $totalOrders);
        View::share('order_details', $order_details);
        View::share('totalPrice', $totalPrice);

        return $next($request);
    }

}
