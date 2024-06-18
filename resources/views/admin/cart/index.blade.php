@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản lý giỏ hàng</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addOrderModal">
                            Tạo đơn hàng
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        STT
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Mã sản phẩm
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tên sản phẩm
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ảnh
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Số lượng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Giá
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kích cỡ
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Màu sắc
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($order_details as $key => $order_detail)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order_detail->product_detail->product->code }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order_detail->product_detail->product->name }}</p>
                                        </td>
                                        <td class="text-center">
                                            <img
                                                src="{{ $order_detail->product_detail->product->image }}"
                                                alt="{{ $order_detail->product_detail->product->name }}"
                                                class="img-fluid"
                                                style="width: 50px; height: 50px;">
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order_detail->amount }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order_detail->price }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order_detail->product_detail->size->size_name }}-{{ $order_detail->product_detail->size->size_number }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order_detail->product_detail->color->name }}</p>
                                            <div
                                                style="width: 20px; height: 20px; background-color: {{ $order_detail->product_detail->color->code }};">
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <form action="{{ route('cart.remove', $key) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                    <td
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tổng tiền:
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


    <!-- Add Order Modal -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrderModalLabel">Thêm thông tin đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form  action="{{ route('orders-store') }}"  method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="receiver" class="form-label">Tên người nhận: </label>
                            <input type="text" class="form-control" id="receiver" name="receiver"
                                   placeholder="Nhập tên người nhận" required>
                        </div>
{{--                        <div class="mb-3">--}}
{{--                            <label for="phone" class="form-label">Số điện thoại: </label>--}}
{{--                            <input type="tel" class="form-control" id="phone" name="phone"--}}
{{--                                   placeholder="Nhập số điện thoại" required>--}}
{{--                        </div>--}}
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ: </label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Nhập địa chỉ" required>
                        </div>
                        <input type="hidden" name="payment_method_id" value="1">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    /* CSS cho tổng tiền */
    tfoot tr td.text-bold {
        font-weight: bold;
    }

    tfoot tr td.text-lg {
        font-size: 2.5rem;
        /* Hoặc kích thước lớn hơn */
    }

    tfoot tr td.text-right {
        text-align: right;
    }
</style>
