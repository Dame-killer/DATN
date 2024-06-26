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

            <span class="stext-109 cl4">
                Giỏ hàng
            </span>
        </div>
    </div>
    <!-- Shoping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        {{-- <div class="container"> --}}
        <div class="row">
            <div class="col-xl-8 col-lg-8 m-l-25 m-r--38 m-lr-0-xl">
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart border-only">
                        <tr class="table_head">
                            <th class="column-0">STT</th>
                            <th class="column-2">Sản phẩm</th>
                            <th class="column-3">Số Lượng</th>
                            <th class="column-3">Giá</th>
                            <th class="column-3">Tổng</th>
                            <th></th>
                        </tr>
                        <tbody>
                            @foreach ($order_details as $order_detail)
                                <tr>
                                    <td>
                                        {{-- <div class="text-x justify-content-center" style="hight-max: auto"> --}}
                                        <h6 class="mb-0 text-sm justify-content-center">{{ $loop->iteration }}</h6>
                                        {{-- </div> --}}
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            <img src="{{ $order_detail->product_detail->product->image }}"
                                                alt="{{ $order_detail->product_detail->product->name }}" class="img-fluid"
                                                style="width: 50px; height: 50px;"><br>
                                            {{ $order_detail->product_detail->product->name }}/{{ $order_detail->product_detail->product->code }}/
                                            {{ $order_detail->product_detail->size->size_name }}
                                            -{{ $order_detail->product_detail->size->size_number }}/{{ $order_detail->product_detail->color->name }}
                                        </p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-sm btn-warning update-quantity"
                                                data-id="{{ $order_detail->product_detail->id }}"
                                                data-action="decrease">-</button>
                                            <p class="text-xs font-weight-bold mb-0 mx-2">{{ $order_detail->amount }}
                                            </p>
                                            <button class="btn btn-sm btn-primary update-quantity"
                                                data-id="{{ $order_detail->product_detail->id }}"
                                                data-action="increase">+</button>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-right font-weight-bold mb-0">{{ number_format($order_detail->unit_price) }}đ</p>
                                    </td>
                                    <td>
                                        <p class="text-right font-weight-bold mb-0 total-price-per-product">
                                            {{ number_format($order_detail->totalPricePerProduct) }}đ</p>
                                    </td>
                                    <td class="text-right">
                                        <form
                                            action="{{ route('customer-cart-remove', $order_detail->product_detail->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">X</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 ms-auto me-2 m-b-50 ">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Tổng cộng
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110 cl2" id="total-price">
                                {{ number_format($totalPrice) }}đ
                            </span>
                        </div>
                    </div>
                    <button type="button"
                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                        data-bs-toggle="modal" data-bs-target="#addOrderModal">
                        Thanh toán
                    </button>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>

    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"> <!-- Add modal-dialog-centered class here -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrderModalLabel">Thêm Thông Tin Đơn Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer-cart-store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="receiver" class="form-label">Tên Người Nhận</label>
                            <input type="text" class="form-control" id="receiver" name="receiver"
                                placeholder="Nhập Tên Người Nhận" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số Điện Thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="Nhập Số Điện Thoại" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa Chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Nhập Địa Chỉ" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method_id" class="form-label">Phương thức thanh toán</label>
                            <select class="form-control" id="payment_method_id" name="payment_method_id" required>
                                <option value="">Chọn PTTT</option>
                                @foreach ($payment_methods as $payment_method)
                                    <option value="{{ $payment_method->id }}">{{ $payment_method->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @if (Auth::check())
                            <input class="form-control" id="userId" name="user_id" value="{{ Auth::user()->id }}"
                                hidden></input>
                        @endif
                        <div class="mb-3">
                            {{-- <input type="hidden" name="payment_method_id" value="1"> --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Xác Nhận</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.querySelectorAll('.update-quantity').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id
                const action = this.dataset.action

                fetch('{{ route('customer-cart-updateQuantity') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id,
                            action
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            const amountElement = this.parentElement.querySelector(
                                '.text-xs.font-weight-bold.mb-0.mx-2')
                            amountElement.textContent = data.amount

                            const totalPricePerProductElement = this.closest('tr').querySelector(
                                '.total-price-per-product')
                            totalPricePerProductElement.textContent = `${data.totalPricePerProduct}đ`

                            const totalPriceElement = document.getElementById('total-price')
                            totalPriceElement.textContent = `${data.totalPrice}đ`
                        }
                    })
                    .catch(error => console.error('Error:', error))
            })
        })
    </script>
@endsection
<style>
    .header {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000;
        /* Example z-index value for header */
    }

    .modal {
        z-index: 1050;
        /* Bootstrap default z-index for modals is usually around this value */
    }


    .bread-crumb a.stext-109,
    .bread-crumb span.stext-109 {
        font-size: 18px;
        /* Thay đổi giá trị này theo kích thước mong muốn */
    }

    .custom-header {
        background-color: rgba(255, 255, 255, 0.8);
        /* Màu nền trắng với độ trong suốt */
        padding-top: 50px;
        padding-bottom: 50px;
        position: relative;
        z-index: 10;
        /* Đảm bảo header đè lên các phần tử khác */
    }

    .table-shopping-cart {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 16px;
        text-align: center;
    }

    .table-shopping-cart th,
    .table-shopping-cart td {
        padding: 12px 15px;
        border: none;
    }

    .table-shopping-cart thead th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: bold;
        border-bottom: 2px solid black;
    }

    .table-shopping-cart tbody tr {
        border-bottom: 1px solid #ddd;
    }

    .table-shopping-cart tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .table-shopping-cart tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table-shopping-cart .text-center {
        text-align: center;
    }

    .table-shopping-cart .text-right {
        text-align: right;
    }

    .table-shopping-cart img {
        max-width: 50px;
        height: auto;
        border-radius: 5px;
    }

    .table-shopping-cart .btn {
        margin: 0 5px;
    }

    .table-shopping-cart .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #fff;
    }

    .table-shopping-cart .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .table-shopping-cart .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }
</style>
