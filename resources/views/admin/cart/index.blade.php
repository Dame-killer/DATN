@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Giỏ Hàng</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addOrderModal">
                            Tạo Đơn Hàng
                        </button>
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
                                        Mã Sản Phẩm
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tên Sản Phẩm
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hình Ảnh
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Số Lượng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Giá
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kích Cỡ
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Màu Sắc
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tổng
                                    </th>
                                    <th class="text-secondary opacity-7">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($order_details as $order_detail)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm ms-2">{{ $loop->iteration }}</h6>
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
                                        <td class="align-middle quantity-column">
                                            <div class="justify-content-center">
                                                {{-- <td class="quantity-column"> --}}
                                                <button class="btn btn-sm btn-warning update-quantity"
                                                        data-id="{{ $order_detail->product_detail->id }}"
                                                        data-action="decrease">-
                                                </button>
                                                <input type="text"
                                                       class="quantity-input text-xs font-weight-bold mb-0 mx-2"
                                                       value="{{ $order_detail->amount }}">
                                                <button class="btn btn-sm btn-primary update-quantity"
                                                        data-id="{{ $order_detail->product_detail->id }}"
                                                        data-action="increase">+
                                                </button>
                                                {{-- </td> --}}
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ number_format($order_detail->unit_price) }} đ
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $order_detail->product_detail->size->size_name }}
                                                - {{ $order_detail->product_detail->size->size_number }}
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                {{ $order_detail->product_detail->color->name }}</p>
                                            <div
                                                style="width: 20px; height: 20px; background-color: {{ $order_detail->product_detail->color->code }}; border: 1px solid #000;">
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0 total-price-per-product">
                                                {{ number_format($order_detail->totalPricePerProduct) }} đ
                                            </p>
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
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                    <td
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tổng Tiền:
                                    </td>
                                    <td class="text-right text-bold text-lg" id="total-price">
                                        {{ number_format($totalPrice) }} đ
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
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrderModalLabel">Thêm Thông Tin Đơn Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('orders-store') }}" method="POST" autocomplete="off">
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
                            <label for="userId" class="form-label">Tài Khoản Khách Hàng</label>
                            <select class="form-control" id="userId" name="user_id">
                                <option value="">Chọn Tài Khoản</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="payment_method_id" value="1">
                        <div class="mb-3">
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
            button.addEventListener('click', function () {
                const id = this.dataset.id
                const action = this.dataset.action

                fetch('{{ route('cart.updateQuantity') }}', {
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

    .quantity-column .btn {
        /* display: flex; */
        align-items: center;
        justify-content: center;
    }

    .quantity-column .btn {
        min-width: 30px;
        padding: 5px 10px;
        font-size: 14px;
        line-height: 1;
    }

    .quantity-input {
        width: 50px;
        text-align: center;
        margin: 0 5px;
        font-size: 14px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .quantity-column .btn-warning {
        background-color: #f0ad4e;
        border-color: #f0ad4e;

    }

    .quantity-column .btn-primary {
        background-color: #0275d8;
        border-color: #0275d8;
    }
</style>
