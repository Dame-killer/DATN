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
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#updatePhoneModal">
                                    Cập nhật số điện thoại
                                </button>
                            @endif
                        </div>
                    </section>
                    <div class="card mb-4">
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
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Mã Đơn Hàng
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Người Nhận
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Địa Chỉ
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Số Điện Thoại
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Ngày Đặt Hàng
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Hạn Thanh Toán
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Phương Thức Thanh Toán
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Mã vận chuyển
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Trạng Thái
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Trạng thái thanh toán
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
                                                <p class="text-xs font-weight-bold mb-0">{{ $order->code }}</p>
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
                                                    @elseif($order->status < 2)
                                                        Đã Hủy
                                                    @else
                                                        N/A
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
                                            <td class="align-middle text-center" id="order-status-{{ $order->id }}">
                                                @switch($order->status)
                                                    @case(0)
                                                        <span class="">Chưa Duyệt</span>
                                                        @break

                                                    @case(1)
                                                        <span class="">Đã Duyệt</span>
                                                        @break

                                                    @case(2)
                                                        <span class="">Đang Giao Hàng</span>
                                                        @break

                                                    @case(3)
                                                        <span class="">Hoàn Thành</span>
                                                        @break

                                                    @case(4)
                                                        <span class="">Hủy</span>
                                                        @break

                                                    @default
                                                        <span class="">Không Xác
                                                                Định</span>
                                                @endswitch
                                            </td>
                                            <td class="align-middle text-center">
                                                @switch($order->payment_status)
                                                    @case(0)
                                                        <span class="">Chưa Thanh
                                                                Toán</span>
                                                        @break

                                                    @case(1)
                                                        <span class="">Đã Thanh Toán</span>
                                                        @break

                                                    @default
                                                        <span class="">Không Xác Định</span>
                                                @endswitch
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('customer-order-detail', $order->id) }}"
                                                   class="btn btn-info btn-sm mb-2">
                                                    Chi Tiết
                                                </a>
                                                @if ($order->status < 2)
                                                    <button class="btn btn-danger btn-sm mb-2 cancel-order-btn"
                                                            data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                            data-id="{{ $order->id }}">
                                                        Hủy
                                                    </button>
                                                @endif
                                                {{--                                                    @if ($order->payment_status == 0 && $order->payment_method_id == 2)--}}
                                                {{--                                                        <button class="btn btn-primary btn-sm mb-2 cancel-order-btn"--}}
                                                {{--                                                            data-bs-toggle="modal" data-bs-target="#cancelOrderModal"--}}
                                                {{--                                                            data-id="{{ $order->id }}">--}}
                                                {{--                                                            Thanh toán--}}
                                                {{--                                                        </button>--}}
                                                {{--                                                    @endif--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cancel Order Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
         aria-hidden="true">
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

    /* modal */
    /* Ensure the modal is centered */
    .modal-dialog-centered {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cancelOrderModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'))
        const cancelOrderButtons = document.querySelectorAll('.cancel-order-btn')

        cancelOrderButtons.forEach(button => {
            button.addEventListener('click', function () {
                const orderId = this.getAttribute('data-id')
                const actionUrl = `/account/${orderId}`
                const form = document.getElementById('cancelOrderForm')
                form.setAttribute('action', actionUrl)
                cancelOrderModal.show()
            });
        });

        const cancelOrderForm = document.getElementById('cancelOrderForm')
        cancelOrderForm.addEventListener('submit', function (event) {
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
