@extends('customer.index')

@section('content')
    <div class="custom-header text-center">
    </div>

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('customer-home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('customer-account') }}" class="stext-109 cl4">
                Tài khoản
            </a>
        </div>
    </div>

    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10"> <!-- Thêm lớp này để giới hạn chiều rộng của form -->
                    <section>
                        <div class='box form-box__border mb-1 w-100'>
                            @if (Auth::check())
                                <div class="row-detail">
                                    <span class="row-detail__label">Tên tài khoản</span>
                                    <p class="row-detail__content">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="row-detail">
                                    <span class="row-detail__label">Email</span>
                                    <p class="row-detail__content">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="row-detail">
                                    <span class="row-detail__label">Số điện thoại</span>
                                    <p class="row-detail__content">{{ Auth::user()->phone }}</p>
                                </div>
                            @endif
                        </div>
                    </section>
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Lịch sử đơn hàng của bạn</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs opacity-7">
                                                STT
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs opacity-7 ps-2">
                                                Mã Sản Phẩm
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs opacity-7 ps-2">
                                                Tên Sản Phẩm
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs opacity-7">
                                                Hình Ảnh
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs opacity-7 ps-2">
                                                Số Lượng
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs opacity-7 ps-2">
                                                Giá
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs opacity-7 ps-2">
                                                Kích Cỡ
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs opacity-7 ps-2">
                                                Màu Sắc
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs opacity-7 ps-2">
                                                Tổng
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_details as $order_detail)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs  mb-0">
                                                        {{ $order_detail->productDetail->product->code }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs  mb-0">
                                                        {{ $order_detail->productDetail->product->name }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ asset('storage/' . $order_detail->productDetail->product->image) }}"
                                                        alt="{{ $order_detail->productDetail->product->name }}"
                                                        class="img-fluid" style="width: 50px; height: 50px;">
                                                </td>
                                                <td>
                                                    <p class="text-xs  mb-0">{{ $order_detail->amount }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs  mb-0">
                                                        {{ $order_detail->unit_price }}đ</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs  mb-0">
                                                        {{ $order_detail->productDetail->size->size_name }}-{{ $order_detail->productDetail->size->size_number }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs  mb-0">
                                                        {{ $order_detail->productDetail->color->name }}</p>
                                                    {{-- <div
                                                        style="width: 20px; height: 20px; background-color: {{ $order_detail->productDetail->color->code }};">
                                                    </div> --}}
                                                </td>
                                                <td>
                                                    <p class="text-xs  mb-0">
                                                        {{ $order_detail->totalPricePerProduct }}đ</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6"></td>
                                            <td class="text-uppercase text-secondary text-xxs er opacity-7 ps-2">
                                                Tổng Tiền:
                                            </td>
                                            <td class="text-right text-bold text-lg" id="total-price">
                                                {{ $totalPrice }}đ
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<style>
    .custom-header {
        background-color: rgba(255, 255, 255, 0.8);
        /* Màu nền trắng với độ trong suốt */
        padding-top: 50px;
        padding-bottom: 50px;
        position: relative;
        z-index: 10;
        /* Đảm bảo header đè lên các phần tử khác */
    }

    .bread-crumb a.stext-109,
    .bread-crumb span.stext-109 {
        font-size: 18px;
        /* Thay đổi giá trị này theo kích thước mong muốn */
    }

    /* Điều chỉnh kích thước của form đăng nhập */
    .form-container {
        max-width: 500px;
        margin: 0 auto;
    }

    /* CSS cho breadcrumb */
    .bread-crumb {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 15px 0;
        margin-bottom: 20px;
    }

    .bread-crumb a {
        color: #343a40;
        text-decoration: none;
        font-size: 14px;
    }

    .bread-crumb a:hover {
        color: #007bff;
    }

    .bread-crumb .fa-angle-right {
        font-size: 12px;
    }

    .form-box__border {
        border: 1px solid #050505;
        padding: 15px;
        border-radius: 5px;
        background-color: #100f0f;
    }

    .row-detail {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }

    .row-detail:last-child {
        border-bottom: none;
    }

    .row-detail__label {
        font-weight: bold;
        color: #333;
        flex-basis: 30%;
    }

    .row-detail__content {
        flex-basis: 70%;
        color: #666;
    }

    .mb-1 {
        margin-bottom: 1rem;
    }

    .w-100 {
        width: 100%;
    }

    /* CSS cho box chứa thông tin tài khoản */
    .box {
        background-color: #ffffff;
        border: 1px solid #e9ecef;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .row-detail {
        margin-bottom: 10px;
    }

    .row-detail__label {
        font-weight: bold;
        color: #555555;
        display: block;
        margin-bottom: 5px;
    }

    .row-detail__content {
        color: #333333;
    }

    /* CSS cho card lịch sử đơn hàng */
    .card {
        border: 1px solid #e9ecef;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 10px 20px;
    }

    .card-header h6 {
        font-size: 18px;
        font-weight: bold;
    }

    .card-body {
        padding: 10px 20px;
    }

    .table {
        width: 100%;
        margin-bottom: 0;
        color: #333333;
    }

    .table th,
    .table td {
        border: none;
        font-weight: normal;
        padding: 10px;
        vertical-align: middle;
    }

    .table th {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        text-transform: uppercase;
        font-size: 12px;
        color: #555555;
    }

    .table td {
        border-bottom: 1px solid #e9ecef;
    }

    .table td:first-child,
    .table th:first-child {
        padding-left: 20px;
    }

    .table td:last-child,
    .table th:last-child {
        padding-right: 20px;
    }
</style>
