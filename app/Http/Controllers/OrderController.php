<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('paymentMethod')->get();

        return view ('admin.order.index')->with(compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver' => 'required|string|max:255',
            'address' => 'required|string|max:255',
//             'phone' => 'nullable|string|max:15',
            'user_id' => 'exists:users,id'
        ]);

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra nếu giỏ hàng không tồn tại hoặc rỗng
        if (empty($cart)) {
            throw new \Exception('Giỏ hàng trống!');
        }

        try {
            // Bắt đầu giao dịch database
            DB::beginTransaction();

            // Tạo đơn hàng mới với các giá trị từ form
            $order = Order::create([
                'receiver' => $request->input('receiver'),
                'address' => $request->input('address'),
                'status' => 0,
                'order_date' => now(),
                'payment_method_id' => $request->input('payment_method_id'),
//                'user_id' => auth()->id() // Lấy id người dùng hiện tại, bạn có thể sử dụng auth()->user()->id nếu sử dụng Laravel Sanctum
                'user_id' => $request->input('user_id'),
            ]);

            // Tạo chi tiết đơn hàng từ giỏ hàng
            foreach ($cart as $item) {
                // Lấy product_detail tương ứng
                $productDetail = ProductDetail::findOrFail($item['id']);

                // Kiểm tra nếu số lượng sản phẩm đủ để đặt hàng
                if ($productDetail->quantity < $item['quantity']) {
                    throw new \Exception('Số lượng sản phẩm không đủ!');
                }

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_detail_id' => $item['id'],
                    'amount' => $item['quantity'],
                    'price' => $item['price']
                ]);

                // Trừ số lượng sản phẩm
                $productDetail->quantity -= $item['quantity'];
                $productDetail->save();
            }

            // Xóa giỏ hàng sau khi tạo đơn hàng thành công
            session()->forget('cart');

            // Commit giao dịch database
            DB::commit();

            return redirect()->route('admin-order')->with('success', 'Đơn hàng đã được tạo thành công.');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, rollback giao dịch và hiển thị thông báo lỗi
            DB::rollback();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function quickApprove(Request $request)
    {
        // Cập nhật tất cả các đơn hàng có status bằng 0 lên 1
        Order::where('status', 0)->update(['status' => 1]);

        return response()->json(['success' => true]);
    }

    public function approveOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        if ($order->status < 3) {
            $order->status += 1;
            $order->save();
            return response()->json(['success' => true, 'status' => $order->status]);
        }

        return response()->json(['success' => false, 'message' => 'Trạng thái đơn hàng không thể tăng thêm.']);
    }
}
