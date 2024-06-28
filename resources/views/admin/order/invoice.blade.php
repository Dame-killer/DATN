<!DOCTYPE html>
<html>
<head>
    <title>Hóa Đơn</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background: #f2f2f2;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
        .invoice-box {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            background: #fff;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        .invoice-box table td {
            padding: 10px;
            vertical-align: top;
        }
        .invoice-box table tr td:nth-child(2),
        .invoice-box table tr td:nth-child(4),
        .invoice-box table tr td:nth-child(6) {
            text-align: right;
        }
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.top table td.title h1 {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            padding: 10px;
        }
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
            text-align: right;
            padding-top: 20px;
            font-size: 18px;
        }
        .title h1 {
            font-size: 36px;
            color: #333;
        }
        .information td, .total td {
            font-weight: bold;
        }
        .invoice-box table tr.item td {
            padding: 15px 0;
        }
        .invoice-box table tr.total td {
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                        <td class="title">
                            <h1>Hóa Đơn</h1>
                        </td>
                        <td>
                            Mã Đơn Hàng #: {{ $orders->code }}<br>
                            Ngày Đặt Hàng: {{ $orders->order_date }}<br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Người Nhận:<br>
                            {{ $orders->receiver }}<br>
                            {{ $orders->address }}<br>
                            {{ $orders->phone }}
                        </td>
                        <td>
                            Tài Khoản Khách Hàng:<br>
                            {{ $orders->user ? $orders->user->email : 'N/A' }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr class="heading">
            <td>Phương Thức Thanh Toán</td>
            <td>{{ $orders->paymentMethod->name }}</td>
        </tr>
        <tr class="heading">
            <td>Mã Vận Đơn</td>
            <td>{{ $orders->tracking_code }}</td>
        </tr>
        <tr class="heading">
            <td>Sản Phẩm</td>
            <td>Kích Cỡ</td>
            <td>Màu Sắc</td>
            <td>Giá</td>
            <td>Số Lượng</td>
            <td>Tổng</td>
        </tr>
        @foreach ($orderDetails as $orderDetail)
            <tr class="item">
                <td>{{ $orderDetail->productDetail->product->code }} - {{ $orderDetail->productDetail->product->name }}</td>
                <td>{{ $orderDetail->productDetail->size->size_name }} - {{ $orderDetail->productDetail->size->size_number }}</td>
                <td>{{ $orderDetail->productDetail->color->name }}</td>
                <td>{{ number_format($orderDetail->unit_price) }} VNĐ</td>
                <td>{{ $orderDetail->amount }}</td>
                <td>{{ number_format($orderDetail->totalPricePerProduct) }} VNĐ</td>
            </tr>
        @endforeach
        <tr class="total">
            <td colspan="4"></td>
            <td>Tổng Cộng</td>
            <td>{{ number_format($totalPrice) }} VNĐ</td>
        </tr>
    </table>
</div>
<script>
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>
