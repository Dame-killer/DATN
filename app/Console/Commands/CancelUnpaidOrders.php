<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelUnpaidOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:cancel-unpaid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Đơn hàng sẽ bị hủy sau 7 ngày nếu không thanh toán!';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Lấy các đơn hàng chưa thanh toán và đã quá 7 ngày
        $orders = Order::where('payment_status', 0)
            ->where('order_date', '<', Carbon::now()->subDays(7))
            ->get();

        foreach ($orders as $order) {
            $order->status = 4; // 4 là trạng thái hủy đơn
            $order->updated_date = Carbon::now();
            $order->save();
        }

        $this->info('Đơn hàng sẽ bị hủy sau 7 ngày nếu không thanh toán!');
    }
}
