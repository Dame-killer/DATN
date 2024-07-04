<!DOCTYPE html>
<html>

<head>
    <title>Hóa Đơn</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>

<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        font-size: 16px;
        line-height: 1.6;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }

    .invoice-box h1 {
        font-size: 36px;
        text-align: center;
        margin-bottom: 20px;
    }

    .invoice-box .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .invoice-box .order-info .order-date,
    .invoice-box .order-info .order-code {
        width: 45%;
    }

    .invoice-box .information {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .invoice-box .payment-info {
        /* display: flex;
        justify-content: space-between; */
        margin-bottom: 20px;
    }

    .invoice-box .information .receiver-info,
    .invoice-box .information .customer-account {
        width: 45%;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
        border-collapse: collapse;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    .label {
        font-weight: bold;
    }
</style>

<body>
    <div class="invoice-box">
        <div class="top">
            <h1>Hóa Đơn</h1>
            <div class="order-info">
                <div class="order-date">
                    <span class="label">Ngày Đặt Hàng:</span> {{ $orders->order_date }}
                </div>
                <div class="order-code">
                    <span class="label">Mã Đơn Hàng:</span> {{ $orders->code }}
                </div>
            </div>
        </div>
        <div class="information">
            <div class="receiver-info">
                <span class="label">Người Nhận: </span>{{ $orders->receiver }}<br>
                <span class="label">Địa chỉ: </span>{{ $orders->address }}<br>
                <span class="label">Số điện thoại: </span>{{ $orders->phone }}
            </div>
            <div class="customer-account">
                <span class="label">Tài Khoản Khách Hàng:</span>{{ $orders->user ? $orders->user->email : 'N/A' }}
            </div>
        </div>
        <div class="payment-info">
            <span class="label">Phương Thức Thanh Toán: </span>{{ $orders->paymentMethod->name }}<br>
            <span class="label">Mã Vận Đơn: </span>{{ $orders->tracking_code ?? 'N/A' }}
        </div>
        <div class="information">
            <table class="m-2">
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
                        <td>{{ $orderDetail->productDetail->product->code }} -
                            {{ $orderDetail->productDetail->product->name }}
                        </td>
                        <td>{{ $orderDetail->productDetail->size->size_name }} -
                            {{ $orderDetail->productDetail->size->size_number }}
                        </td>
                        <td>{{ $orderDetail->productDetail->color->name }}</td>
                        <td>{{ number_format($orderDetail->unit_price) }}VNĐ</td>
                        <td>{{ $orderDetail->amount }}</td>
                        <td>{{ number_format($orderDetail->totalPricePerProduct) }}VNĐ</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td colspan="4"></td>
                    <td>Tổng Cộng</td>
                    <td>{{ number_format($totalPrice) }}VNĐ</td>
                </tr>
            </table>
        </div>

    </div>


     <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>
