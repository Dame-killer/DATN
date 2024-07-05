<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VNPayController extends Controller
{
    public function checkout()
    {
        return view('customer.checkout');
    }

    public function createPayment()
    {
        $vnp_TmnCode = "ONHK27YO"; //Mã website tại VNPAY
        $vnp_HashSecret = "HX4UTYXJJAVGUIYTF9EY0RFDBT8N6M5V"; //Chuỗi bí mật

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TxnRef = rand(1,10000); //Mã đơn hàng. Trong thực tế bạn cần thay đổi mã này thành mã đơn hàng của bạn
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 150 * 100;
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

    public function vnpayReturn()
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
        // dd($secureHash);
        if ($secureHash == $vnp_SecureHash) {
            // Kiểm tra mã đơn hàng trong database để xử lý
            // Logic xử lý kết quả thanh toán của bạn tại đây
            return view('customer.vnpay_return', ['inputData' => $inputData]);
        } else {
            // Xử lý khi có lỗi
            return view('customer.vnpay_return', ['inputData' => $inputData, 'error' => 'Invalid Signature']);
        }
    }
}
