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
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updatePhoneModal">
                                    Cập nhật số điện thoại
                                </button>
                            @endif
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </section>
    <div class="card mb-4 m-2">
        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h6>Lịch sử đơn hàng của bạn</h6>
            <p>Tra cứu mã vận đơn
                <a href="https://ghn.vn/blogs/trang-thai-don-hang" target="_blank">tại đây</a>
            </p>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                STT
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Mã Đơn Hàng
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Người Nhận
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Địa Chỉ
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                SĐT
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Ngày Đặt Hàng
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Hạn Thanh Toán
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                PTTT
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Mã vận chuyển
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Trạng Thái
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                TTTT
                            </th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs onft-weight-bold mb-0">{{ $order->code }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->receiver }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->address }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->phone }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $order->order_date }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        @if ($order->days_left > 0 && $order->payment_status == 0)
                                            Còn {{ $order->days_left }} ngày
                                        @elseif($order->payment_status == 1)
                                            N/A
                                        @else
                                            Đã Hủy
                                        @endif
                                    </p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $order->paymentMethod->name }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $order->tracking_code }}</p>
                                </td>
                                <td id="order-status-{{ $order->id }}">
                                    @switch($order->status)
                                        @case(0)
                                            <span class="status pending">Chưa Duyệt</span>
                                        @break

                                        @case(1)
                                            <span class="status approved">Đã Duyệt</span>
                                        @break

                                        @case(2)
                                            <span class="status shipping">Đang Giao Hàng</span>
                                        @break

                                        @case(3)
                                            <span class="status completed">Hoàn Thành</span>
                                        @break

                                        @case(4)
                                            <span class="status cancelled">Hủy</span>
                                        @break

                                        @default
                                            <span class="status unknown">Không Xác Định</span>
                                    @endswitch
                                </td>
                                <td>
                                    @switch($order->payment_status)
                                        @case(0)
                                            <span class="payment-status unpaid">Chưa Thanh Toán</span>
                                        @break

                                        @case(1)
                                            <span class="payment-status paid">Đã Thanh Toán</span>
                                        @break

                                        @default
                                            <span class="payment-status unknown">Không Xác Định</span>
                                    @endswitch
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('customer-order-detail', $order->id) }}"
                                            class="btn btn-info btn-sm mb-2">Chi Tiết</a>
                                        @if ($order->status < 2)
                                            <button class="btn btn-danger btn-sm mb-2 cancel-order-btn"
                                                data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                data-id="{{ $order->id }}">Hủy</button>
                                        @endif
                                        @if ($order->payment_status == 0 && $order->status < 2)
                                            <form action="{{ route('customer-order-pay', $order->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm mb-2">Thanh
                                                    toán</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Cancel Order Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelOrderModalLabel">Xác Nhận Hủy Đơn Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn hủy đơn hàng này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Đóng</button>
                    <form action="{{ route('customer-order-cancel', ['id' => ':id']) }}" method="POST"
                        id="cancelOrderForm">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger m-1">Hủy Đơn Hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Phone Modal -->
    <div class="modal fade" id="updatePhoneModal" tabindex="-1" aria-labelledby="updatePhoneModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePhoneModalLabel">Cập Nhật Số Điện Thoại</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('customer-update-phone') }}" method="POST" id="updatePhoneForm">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại mới</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                value="{{ Auth::user()->phone }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cancelOrderModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'))
        const cancelOrderButtons = document.querySelectorAll('.cancel-order-btn')

        cancelOrderButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-id')
                const actionUrl = `/account/${orderId}`
                const form = document.getElementById('cancelOrderForm')
                form.setAttribute('action', actionUrl)
                cancelOrderModal.show()
            });
        });

        const cancelOrderForm = document.getElementById('cancelOrderForm')
        cancelOrderForm.addEventListener('submit', function(event) {
            event.preventDefault()
            const actionUrl = this.getAttribute('action')
            fetch(actionUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(() => {
                    // Cập nhật trạng thái đơn hàng trên giao diện
                    const orderId = cancelOrderForm.getAttribute('data-id')
                    const orderStatusElement = document.getElementById(`order-status-${orderId}`)
                    if (orderStatusElement) {
                        orderStatusElement.innerHTML =
                            '<span class="badge badge-sm bg-gradient-danger">Hủy</span>'
                    }
                    alert('Đơn hàng đã được hủy thành công!')
                    cancelOrderModal.hide() // Đóng modal sau khi xử lý xong

                    // Tải lại trang sau khi xử lý thành công
                    location.reload()
                })
                .catch(error => {
                    console.error('Error:', error)
                    alert('Đã xảy ra lỗi, vui lòng thử lại!')
                })
        })
    })
</script>
<style>
    .form-box__border {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 5px;
        background-color: #f9f9f9;
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

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 1.25rem;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .card-header h6 {
        margin: 0;
        font-size: 1.25rem;
        color: #343a40;
    }

    .card-header p {
        margin: 0;
        font-size: 0.875rem;
        color: #6c757d;
    }

    .card-header a {
        color: #007bff;
        text-decoration: none;
    }

    .card-header a:hover {
        text-decoration: underline;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead th {
        background-color: #f8f9fa;
        text-align: left;
        padding: 12px 15px;
        border-bottom: 2px solid #dee2e6;
        font-size: 0.875rem;
        color: #6c757d;
    }

    thead th.text-center {
        text-align: center;
    }

    tbody td {
        padding: 12px 15px;
        border-bottom: 1px solid #dee2e6;
        font-size: 0.875rem;
        color: #343a40;
    }

    tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }


    .btn {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .btn-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        line-height: 1.25;
        border-radius: 0.2rem;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
    }

    .btn-group form {
        display: inline;
    }

    .status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        font-weight: bold;
        border-radius: 0.25rem;
        text-align: center;
    }

    .status.pending {
        background-color: #f0ad4e;
        color: white;
    }

    .status.approved {
        background-color: #5bc0de;
        color: white;
    }

    .status.shipping {
        background-color: #0275d8;
        color: white;
    }

    .status.completed {
        background-color: #5cb85c;
        color: white;
    }

    .status.cancelled {
        background-color: #d9534f;
        color: white;
    }

    .status.unknown {
        background-color: #6c757d;
        color: white;
    }

    .payment-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        font-weight: bold;
        border-radius: 0.25rem;
        text-align: center;
    }

    .payment-status.unpaid {
        background-color: #f0ad4e;
        color: white;
    }

    .payment-status.paid {
        background-color: #5cb85c;
        color: white;
    }

    .payment-status.unknown {
        background-color: #6c757d;
        color: white;
    }
</style>
