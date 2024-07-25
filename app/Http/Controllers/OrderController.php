<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $query->orderBy('id', 'desc');
        $orders = $query->paginate(5);

        return view('admin.order.index')->with(compact('orders'));
    }

    public function indexCustomer()
    {

        $orders = Order::with('paymentMethod')->where('user_id', auth()->user()->id)->get();

        foreach ($orders as $order) {
            $createdDate = Carbon::parse($order->order_date);
            $expiryDate = $createdDate->addDays(7);
            $daysLeft = Carbon::now()->diffInDays($expiryDate, false);

            // Nếu số ngày còn lại nhỏ hơn 0, điều đó có nghĩa là đơn hàng đã quá hạn
            if ($daysLeft < 0) {
                $daysLeft = 0;
            }

            $order->days_left = $daysLeft;
        }

        return view('customer.account')->with(compact('orders'));
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
            'phone' => 'required|string|max:10',
            'user_id' => 'nullable|exists:users,id'
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
                'phone' => $request->input('phone'),
                'status' => 3,
                'payment_status' => 1,
                'payment_method_id' => $request->input('payment_method_id'),
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
                    'unit_price' => $item['attributes']['product_price']
                ]);

                // Trừ số lượng sản phẩm
                $productDetail->quantity -= $item['quantity'];
                $productDetail->save();
            }

            // Xóa giỏ hàng sau khi tạo đơn hàng thành công
            session()->forget('cart');

            // Commit giao dịch database
            DB::commit();

            return redirect()->route('admin-order')->with('success', 'Đơn hàng đã được tạo thành công!');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, rollback giao dịch và hiển thị thông báo lỗi
            DB::rollback();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }

    public function storeCustomer(Request $request)
    {
        $data = $request->validate([
            'receiver' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'nullable|string|max:10',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        } else {
            $data['user_id'] = null;
        }

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Kiểm tra nếu giỏ hàng không tồn tại hoặc rỗng
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        try {
            // Bắt đầu giao dịch database
            DB::beginTransaction();

            // Tạo đơn hàng mới với các giá trị từ form
            $order = Order::create([
                'receiver' => $request->input('receiver'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'payment_method_id' => $request->input('payment_method_id'),
                'user_id' => $data['user_id'],
            ]);

            // Tạo chi tiết đơn hàng từ giỏ hàng
            foreach ($cart as $item) {
                // Lấy product_detail tương ứng
                $productDetail = ProductDetail::findOrFail($item['id']);

                // Kiểm tra nếu số lượng sản phẩm đủ để đặt hàng
                if ($productDetail->quantity < $item['quantity']) {
                    return redirect()->back()->with('error', 'Số lượng sản phẩm không đủ!');
                }

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_detail_id' => $item['id'],
                    'amount' => $item['quantity'],
                    'unit_price' => $item['attributes']['product_price']
                ]);


                // Trừ số lượng sản phẩm
                $productDetail->quantity -= $item['quantity'];
                $productDetail->save();
            }

            // Xóa giỏ hàng sau khi tạo đơn hàng thành công
            session()->forget('cart');

            // Commit giao dịch database
            DB::commit();
            $order_details = OrderDetail::with('productDetail', 'productDetail.product', 'productDetail.size', 'productDetail.color')->where('order_id', $order->id)->get();

            // Tính tổng giá từng sản phẩm và tổng giá tất cả các sản phẩm
            $totalPrice = 0;
            foreach ($order_details as $order_detail) {
                $order_detail->totalPricePerProduct = $order_detail->unit_price * $order_detail->amount;
                $totalPrice += $order_detail->totalPricePerProduct;
            }
            // Kiểm tra nếu phương thức thanh toán là VNPay
            if ($request->input('payment_method_id') == '3') {
                // Gọi hàm tạo thanh toán VNPay
                $paymentUrl = $this->createPayment($order, $totalPrice);
                return redirect($paymentUrl);
            }

            return redirect()->route('customer-home')->with('success', 'Đơn hàng đã được tạo thành công.');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, rollback giao dịch và hiển thị thông báo lỗi
            DB::rollback();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }

    public function pay($orderId)
    {
        $order = Order::findOrFail($orderId);

        $order_details = OrderDetail::with('productDetail', 'productDetail.product', 'productDetail.size', 'productDetail.color')->where('order_id', $orderId)->get();

        // Tính tổng giá từng sản phẩm và tổng giá tất cả các sản phẩm
        $totalPrice = 0;
        foreach ($order_details as $order_detail) {
            $order_detail->totalPricePerProduct = $order_detail->unit_price * $order_detail->amount;
            $totalPrice += $order_detail->totalPricePerProduct;
        }

        // Gọi hàm tạo thanh toán VNPay
        $paymentUrl = $this->createPayment($order, $totalPrice);

        // Redirect to the payment URL
        return redirect($paymentUrl);
    }

    public function createPayment($order, $totalPrice)
    {
        $vnp_TmnCode = "ONHK27YO"; // Mã website tại VNPAY
        $vnp_HashSecret = "HX4UTYXJJAVGUIYTF9EY0RFDBT8N6M5V"; // Chuỗi bí mật
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TxnRef = $order->id; // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $totalPrice * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:" . $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = "HX4UTYXJJAVGUIYTF9EY0RFDBT8N6M5V";
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        $i = 0;
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            // Kiểm tra mã đơn hàng trong database để xử lý
            $orderId = $request->input('vnp_TxnRef');
            $order = Order::where('id', $orderId)->first();

            if ($order) {
                // Cập nhật trạng thái thanh toán của đơn hàng thành 1
                $order->payment_status = 1;
                $order->save();

                // Logic xử lý kết quả thanh toán thành công của bạn tại đây
                return redirect()->route('customer-home')->with('success', 'Đơn hàng đã được thanh toán thành công!');
            } else {
                // Xử lý khi không tìm thấy đơn hàng
                return redirect()->route('checkout')->with('error', 'Không tìm thấy đơn hàng!');
            }
        } else {
            // Xử lý khi có lỗi
            return redirect()->route('checkout')->with('error', 'Thanh toán thất bại!');
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
            if ($order->status == 1 && $request->status == 2) {
                // Khi chuyển trạng thái từ Đã Duyệt (1) sang Đang Giao Hàng (2), lưu mã vận đơn
                $order->tracking_code = $request->tracking_code;
            }

            if ($order->payment_method_id == 1 && $order->status == 1) {
                $order->status = 3;
                $order->save();

                return response()->json(['success' => true, 'status' => $order->status]);
            }

            if ($order->payment_method_id == 2 && $order->status == 2) {
                $order->status = 3;
                $order->payment_status = 1;
                $order->save();

                return response()->json(['success' => true, 'status' => $order->status]);
            }

            $order->status += 1;
            $order->updated_date = Carbon::now();
            $order->save();

            return response()->json(['success' => true, 'status' => $order->status, 'tracking_code' => $order->tracking_code]);
        }

        return response()->json(['success' => false, 'message' => 'Trạng thái đơn hàng không thể tăng thêm!']);
    }

    public function cancelOrder($id)
    {
        try {
            // Tìm đơn hàng và kiểm tra tồn tại
            $order = Order::findOrFail($id);

            // Kiểm tra xem đơn hàng đã được hủy hay chưa
            if ($order->status === 4) {
                throw new \Exception('Đơn hàng đã được hủy trước đó!');
            }

            // Bắt đầu giao dịch database
            DB::beginTransaction();

            // Đặt trạng thái của đơn hàng thành "Hủy" (status = 4)
            $order->status = 4;
            $order->updated_date = Carbon::now();
            $order->save();

            // Lấy danh sách các chi tiết đơn hàng để phục hồi số lượng sản phẩm
            $orderDetails = OrderDetail::where('order_id', $id)->get();

            foreach ($orderDetails as $orderDetail) {
                $productDetail = $orderDetail->productDetail;

                // Phục hồi số lượng sản phẩm
                $productDetail->quantity += $orderDetail->amount;
                $productDetail->save();
            }

            // Commit giao dịch database
            DB::commit();

            return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công và số lượng sản phẩm đã được phục hồi.');
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, rollback giao dịch và hiển thị thông báo lỗi
            DB::rollback();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi hủy đơn hàng: ' . $e->getMessage());
        }
    }

    public function printInvoice($order)
    {
        $orders = Order::with('paymentMethod', 'user')->findOrFail($order);
        $orderDetails = OrderDetail::with('productDetail', 'productDetail.product', 'productDetail.size', 'productDetail.color')->where('order_id', $order)->get();
        $totalPrice = 0;

        foreach ($orderDetails as $orderDetail) {
            $orderDetail->totalPricePerProduct = $orderDetail->unit_price * $orderDetail->amount;
            $totalPrice += $orderDetail->totalPricePerProduct;
        }

        return view('admin.order.invoice', compact('orders', 'orderDetails', 'totalPrice'));
    }
}
