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

        // Lấy tổng số lượng đơn hàng từ database nếu người dùng đã đăng nhập
        if (Auth::check()) {
            $userTotalOrders = OrderDetail::where('user_id', Auth::id())->sum('amount');
            $totalOrders += $userTotalOrders;
        }

        View::share('totalOrders', $totalOrders);

        return $next($request);
    }
}
