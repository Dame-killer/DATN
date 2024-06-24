@extends('customer.index')

@section('content')
    <!-- Dải màu đen với tiêu đề ở trên cùng -->
    <div class="bg-dark text-white py-2 text-center">
        <h1 class="mb-0">Trang tài khoản</h1>
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
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                STT
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Mã đơn hàng
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Ngày đặt
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Thành tiền
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                TT thanh toán
                                            </th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
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
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $order_detail->product_detail->product->code }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $order_detail->product_detail->product->name }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <img src="{{ $order_detail->product_detail->product->image }}"
                                                        alt="{{ $order_detail->product_detail->product->name }}"
                                                        class="img-fluid" style="width: 50px; height: 50px;">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <button class="btn btn-sm btn-warning update-quantity"
                                                            data-id="{{ $order_detail->product_detail->id }}"
                                                            data-action="decrease">-</button>
                                                        <p class="text-xs font-weight-bold mb-0 mx-2">
                                                            {{ $order_detail->amount }}</p>
                                                        <button class="btn btn-sm btn-primary update-quantity"
                                                            data-id="{{ $order_detail->product_detail->id }}"
                                                            data-action="increase">+</button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $order_detail->price }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $order_detail->product_detail->size->size_name }}-{{ $order_detail->product_detail->size->size_number }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $order_detail->product_detail->color->name }}</p>
                                                    <div
                                                        style="width: 20px; height: 20px; background-color: {{ $order_detail->product_detail->color->code }};">
                                                    </div>
                                                </td>
                                                <td class="text-right">
                                                    <form
                                                        action="{{ route('cart.remove', $order_detail->product_detail->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody> --}}
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

    /* CSS cho dải màu đen với tiêu đề */
    .bg-dark {
        background-color: #343a40;
        padding: 10px 0;
        margin: 2px;
    }

    .bg-dark h1 {
        font-size: 24px;
        font-weight: bold;
        text-transform: uppercase;
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
