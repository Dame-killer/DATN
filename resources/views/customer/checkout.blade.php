@extends('customer.index')

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Thanh toán</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('customer-home') }}">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Thanh toán</p>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <!-- Left Column: Order Information Form -->
            <div class="col-md-6">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông Tin Đơn Hàng</h5>
                    </div>
                    <div class="modal-body">
                        <form id="order-form" action="{{ route('customer-cart-store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="receiver" class="form-label">Tên Người Nhận</label>
                                <input type="text" class="form-control" id="receiver" name="receiver"
                                    placeholder="Nhập Tên Người Nhận" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số Điện Thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    placeholder="Nhập Số Điện Thoại" maxlength="11" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa Chỉ</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Nhập Địa Chỉ" required>
                            </div>
                            @if (Auth::check())
                                <input class="form-control" id="userId" name="user_id" value="{{ Auth::user()->id }}"
                                    hidden></input>
                            @endif

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Phương Thức Thanh Toán</label>
                                <div>
                                    @foreach ($payment_methods as $payment_method)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="payment_method_id"
                                                id="payment_method_{{ $payment_method->id }}"
                                                value="{{ $payment_method->id }}" required>
                                            <label class="form-check-label" for="payment_method_{{ $payment_method->id }}">
                                                {{ $payment_method->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" name="redirect">Xác Nhận</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column: Cart Display -->
            <div class="col-md-6">
                <div class="cart-content">
                    <!-- Add your cart display code here -->
                    <h5>Giỏ Hàng</h5>
                    <!-- Example cart items -->
                    <ul class="list-group">
                        @foreach ($order_details as $order_detail)
                            <li class="list-group-item">
                                <img src="{{ $order_detail->product_detail->product->image }}"
                                    alt="{{ $order_detail->product_detail->product->name }}" class="img-fluid"
                                    style="width: 50px">
                                {{ $order_detail->product_detail->product->name }} /
                                {{ $order_detail->product_detail->product->code }} /
                                {{ $order_detail->product_detail->size->size_name }} -
                                {{ $order_detail->product_detail->size->size_number }} /
                                {{ $order_detail->product_detail->color->name }}
                            </li>
                        @endforeach
                    </ul>
                    {{-- <div class="col-xl-4 col-lg-4 ms-auto me-2 m-b-50 "> --}}
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
                                <span class="stext-110 cl2">
                                    Tổng cộng
                                </span>
                            </div>
                            <div class="size-209">
                                <span class="mtext-110 cl2" id="total-price">
                                    {{ number_format($totalPrice) }} đ
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('phone').addEventListener('input', function (event) {
            this.value = this.value.replace(/[^0-9]/g, '')
        })
    </script>
@endsection
