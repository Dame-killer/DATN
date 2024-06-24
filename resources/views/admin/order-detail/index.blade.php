@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản lý đơn hàng chi tiết</h6>
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
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
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
                                                <p class="text-xs font-weight-bold mb-0">{{ $order_detail->productDetail->product->code }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $order_detail->productDetail->product->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                <img
                                                    src="{{ asset('storage/' . $order_detail->productDetail->product->image) }}"
                                                    alt="{{ $order_detail->productDetail->product->name }}"
                                                    class="img-fluid"
                                                    style="width: 50px; height: 50px;">
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $order_detail->amount }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $order_detail->price }}đ</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $order_detail->productDetail->size->size_name }}-{{ $order_detail->productDetail->size->size_number }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $order_detail->productDetail->color->name }}</p>
                                                <div
                                                    style="width: 20px; height: 20px; background-color: {{ $order_detail->productDetail->color->code }};">
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $order_detail->totalPricePerProduct }}đ</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6"></td>
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
