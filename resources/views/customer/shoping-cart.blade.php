@extends('customer.index')

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ hàng</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('customer-home') }}">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Giỏ hàng</p>
            </div>
        </div>
    </div>
    <!-- Shoping Cart -->
    <div class="bg0 p-t-75 p-b-85">
        {{-- <div class="container"> --}}
        <div class="row px-xl-5">
            <div class="col-xl-8 col-lg-8 m-l-25 m-r--38 m-lr-0-xl">
                {{-- <div class="wrap-table-shopping-cart"> --}}
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                            <th></th>
                        </tr>
                    <tbody class="align-middle">
                        @foreach ($order_details as $order_detail)
                            <tr>
                                <td class="align-middle">
                                    {{-- <p class="text-xs font-weight-bold mb-0"> --}}
                                    <img src="{{ $order_detail->product_detail->product->image }}"
                                        alt="{{ $order_detail->product_detail->product->name }}" class="img-fluid"
                                        style="width: 50px">
                                    {{ $order_detail->product_detail->product->name }}/{{ $order_detail->product_detail->product->code }}/
                                    {{ $order_detail->product_detail->size->size_name }}
                                    -{{ $order_detail->product_detail->size->size_number }}/{{ $order_detail->product_detail->color->name }}
                                    </p>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning update-quantity"
                                                data-id="{{ $order_detail->product_detail->id }}" data-action="decrease">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center"
                                            value="{{ $order_detail->amount }}">
                                        {{-- <p class="text-xs font-weight-bold mb-0 mx-2">{{ $order_detail->amount }} --}}
                                        {{-- </p> --}}
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary update-quantity"
                                                data-id="{{ $order_detail->product_detail->id }}" data-action="increase">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="text-right font-weight-bold mb-0">
                                        {{ number_format($order_detail->unit_price) }}đ</p>
                                </td>
                                <td class="align-middle">
                                    <p class="text-right font-weight-bold mb-0 total-price-per-product">
                                        {{ number_format($order_detail->totalPricePerProduct) }}đ</p>
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('customer-cart-remove', $order_detail->product_detail->id) }}"
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
                {{-- </div> --}}
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
    th,
    td {
        padding: 12px 15px;
        border: none;
    }

    thead th {
        background-color: #f8f9fa;
        color: #333;
        font-weight: bold;
        border-bottom: 2px solid black;
    }

    tbody tr {
        border-bottom: 1px solid #ddd;
    }

    tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    img {
        max-width: 50px;
        height: auto;
        border-radius: 5px;
    }


    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }
</style>
