<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;
class VNPayController extends Controller
{
    public function checkout()
    {
        $payment_methods = PaymentMethod::all();
        $vnpay_method_id = $payment_methods->firstWhere('name', 'VNPAY')->id;
        return view('customer.checkout')->with(compact('payment_methods', 'vnpay_method_id'));
    }

    public function createPayment(Request $request)
    {
        $vnp_TmnCode = "ONHK27YO"; //Mã website tại VNPAY
        $vnp_HashSecret = "HX4UTYXJJAVGUIYTF9EY0RFDBT8N6M5V"; //Chuỗi bí mật

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TxnRef = $request->code; //Mã đơn hàng. Trong thực tế bạn cần thay đổi mã này thành mã đơn hàng của bạn
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->totalPrice * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount* 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => "Thanh toan GD:",
            "vnp_OrderType" => "other",
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        // dd($inputData);
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
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array( 'code' => '00',
            'message'=> 'success',
            'data'=> $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                // Xử lý trả về JSON khi không có yêu cầu redirect
                $returnData = [
                    'code' => '00',
                    'message' => 'success',
                    'data' => $vnp_Url,
                ];
                return response()->json($returnData);
            }

    }


}
