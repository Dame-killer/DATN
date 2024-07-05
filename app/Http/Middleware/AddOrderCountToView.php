<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Order;

class AddOrderCountToView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $newOrders = Order::where('status', 0)->get();
        $newOrdersCount = $newOrders->count();

        View::share('newOrders', $newOrders);
        View::share('newOrdersCount', $newOrdersCount);

        return $next($request);
    }
    
}
