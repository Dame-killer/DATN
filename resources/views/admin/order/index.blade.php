@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Đơn Hàng</h6>
                    </div>
                    <div class="search-container">
                        <form class="d-flex align-items-center search-bar" method="GET"
                              action="{{ route('admin-order') }}">
                            <input class="form-control form-control-sm custom-input" type="search" name="search"
                                   placeholder="Nhập Từ Khóa" aria-label="Tìm kiếm" value="{{ request('search') }}">
                            <select class="form-control form-control-sm custom-select m-1" name="status">
                                <option value="">Tất cả trạng thái</option>
                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Chưa Duyệt</option>
                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đã Duyệt</option>
                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Đang Giao Hàng
                                </option>
                                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Hoàn Thành</option>
                                <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Hủy</option>
                            </select>
                            <button class="btn btn-outline-success btn-sm custom-button m-1" type="submit">
                                Tìm Kiếm
                            </button>
                        </form>
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
                                        Phương Thức Thanh Toán
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tài Khoản Khách Hàng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Mã Vận Đơn
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Trạng Thái
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Thao tác
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr id="order-{{ $order->id }}">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm ms-2">{{ $loop->iteration }}</h6>
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
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->paymentMethod->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->user ? $order->user->email : 'N/A' }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0"
                                               id="tracking-code-{{ $order->id }}">{{ $order->tracking_code ?? 'N/A' }}
                                            </p>
                                        </td>
                                        <td class="align-middle text-center" id="order-status-{{ $order->id }}">
                                            @switch($order->status)
                                                @case(0)
                                                    <span class="badge badge-sm bg-gradient-secondary">Chưa Duyệt</span>
                                                    @break
                                                @case(1)
                                                    <span class="badge badge-sm bg-gradient-info">Đã Duyệt</span>
                                                    @break
                                                @case(2)
                                                    <span
                                                        class="badge badge-sm bg-gradient-warning">Đang Giao Hàng</span>
                                                    @break
                                                @case(3)
                                                    <span class="badge badge-sm bg-gradient-success">Hoàn Thành</span>
                                                    @break
                                                @case(4)
                                                    <span class="badge badge-sm bg-gradient-danger">Hủy</span>
                                                    @break
                                                @default
                                                    <span
                                                        class="badge badge-sm bg-gradient-faded-dark">Không Xác Định</span>
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin-order-detail', $order->id) }}"
                                               class="btn btn-info btn-sm mb-2">
                                                Chi Tiết
                                            </a>
                                            <button class="btn btn-warning btn-sm mb-2 approve-order-btn"
                                                    data-id="{{ $order->id }}" data-status="{{ $order->status }}"
                                                    data-payment-method-id="{{ $order->payment_method_id }}">
                                                @if ($order->status == 0)
                                                    Duyệt
                                                @else
                                                    Cập Nhật
                                                @endif
                                            </button>
                                            @if ($order->status < 2)
                                                <button class="btn btn-danger btn-sm mb-2 cancel-order-btn"
                                                        data-bs-toggle="modal" data-bs-target="#cancelOrderModal"
                                                        data-id="{{ $order->id }}">
                                                    Hủy
                                                </button>
                                            @endif
                                            <a href="{{ route('admin-order-invoice', $order->id) }}"
                                               class="btn btn-success btn-sm mb-2">
                                                In Hóa Đơn
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $orders->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Order Modal -->
    <div class="modal fade" id="cancelOrderModal" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelOrderModalLabel">Xác Nhận Hủy Đơn Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có chắc chắn muốn hủy đơn hàng này?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <form action="{{ route('admin-order-cancel', ['id' => ':id']) }}" method="POST"
                          id="cancelOrderForm">
                        @method('PUT')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hủy Đơn Hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Tracking Code Modal -->
    <div class="modal fade" id="trackingCodeModal" tabindex="-1" aria-labelledby="trackingCodeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trackingCodeModalLabel">Nhập Mã Vận Đơn</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="trackingCodeForm">
                        <div class="mb-3">
                            <label for="trackingCode" class="form-label">Mã Vận Đơn</label>
                            <input type="text" class="form-control" id="trackingCode" name="tracking_code"
                                   placeholder="Nhập Mã Vận Đơn" required>
                        </div>
                        <input type="hidden" id="orderId" name="order_id">
                        <input type="hidden" id="orderStatus" name="status">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveTrackingCodeBtn">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('quickApproveButton').addEventListener('click', function () {
                fetch('{{ route('admin-orders-quick-approve') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const rows = document.querySelectorAll('tbody tr')
                            rows.forEach(row => {
                                const statusCell = row.querySelector('td[id^="order-status-"]')
                                const statusText = statusCell.textContent.trim()
                                if (statusText === 'Chưa Duyệt') {
                                    statusCell.innerHTML =
                                        `<p class="text-xs font-weight-bold mb-0">Đã Duyệt</p>`
                                }
                            })
                        } else {
                            alert('Có Lỗi Xảy Ra!')
                        }
                    })
                    .catch(error => console.error('Error:', error))
            })
        })

        document.addEventListener('DOMContentLoaded', function () {
            const approveButtons = document.querySelectorAll('.approve-order-btn')
            const trackingCodeModal = new bootstrap.Modal(document.getElementById('trackingCodeModal'))
            const saveTrackingCodeBtn = document.getElementById('saveTrackingCodeBtn')

            approveButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = button.getAttribute('data-id')
                    const orderStatus = parseInt(button.getAttribute('data-status'))
                    const paymentMethodId = parseInt(button.getAttribute('data-payment-method-id'))

                    if (orderStatus === 1 && paymentMethodId === 1) {
                        updateOrderStatus(orderId, orderStatus)
                    } else if (orderStatus === 1) {
                        document.getElementById('orderId').value = orderId
                        document.getElementById('orderStatus').value = orderStatus
                        trackingCodeModal.show()
                    } else {
                        updateOrderStatus(orderId, orderStatus)
                    }
                })
            })

            saveTrackingCodeBtn.addEventListener('click', function () {
                const orderId = document.getElementById('orderId').value
                const orderStatus = document.getElementById('orderStatus').value
                const trackingCode = document.getElementById('trackingCode').value

                if (trackingCode.trim() === '') {
                    alert('Mã vận đơn không được để trống!')
                    return
                }

                updateOrderStatus(orderId, parseInt(orderStatus), trackingCode)
                trackingCodeModal.hide()
            })

            function updateOrderStatus(orderId, orderStatus, trackingCode = null) {
                fetch(`/admin/order/approve/${orderId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: orderStatus === 1 ? 2 : orderStatus,
                        tracking_code: trackingCode
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            refreshOrderList()
                            alert(data.message || 'Trạng thái đơn hàng đã được cập nhật thành công!')
                        } else {
                            alert(data.message || 'Có lỗi xảy ra!')
                        }
                    })
                    .catch(error => console.error('Error:', error))
            }

            function refreshOrderList() {
                const searchParams = new URLSearchParams(window.location.search)
                fetch(`/admin/order?${searchParams.toString()}`)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser()
                        const doc = parser.parseFromString(html, 'text/html')
                        const newTableBody = doc.querySelector('table tbody')
                        const currentTableBody = document.querySelector('table tbody')
                        currentTableBody.innerHTML = newTableBody.innerHTML
                        bindEventsToNewButtons()
                    })
                    .catch(error => console.error('Error:', error))
            }

            function bindEventsToNewButtons() {
                const newApproveButtons = document.querySelectorAll('.approve-order-btn')
                newApproveButtons.forEach(button => {
                    button.addEventListener('click', function () {
                        const orderId = button.getAttribute('data-id')
                        const orderStatus = parseInt(button.getAttribute('data-status'))
                        const paymentMethodId = parseInt(button.getAttribute('data-payment-method-id'))

                        if (orderStatus === 1 && paymentMethodId === 1) {
                            updateOrderStatus(orderId, orderStatus)
                        } else if (orderStatus === 1) {
                            document.getElementById('orderId').value = orderId
                            document.getElementById('orderStatus').value = orderStatus
                            trackingCodeModal.show()
                        } else {
                            updateOrderStatus(orderId, orderStatus)
                        }
                    })
                })
            }
        })

        document.addEventListener('DOMContentLoaded', function () {
            const cancelOrderModal = new bootstrap.Modal(document.getElementById('cancelOrderModal'))
            const cancelOrderButtons = document.querySelectorAll('.cancel-order-btn')

            cancelOrderButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = this.getAttribute('data-id')
                    const actionUrl = `/admin/order/cancel/${orderId}`
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
                            orderStatusElement.innerHTML = '<span class="badge badge-sm bg-gradient-danger">Hủy</span>'
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
@endsection
<style>
    .search-container {
        display: flex;
        justify-content: flex-start;
        /* Align items to the left */
        align-items: center;
        padding: 5px;
        margin-bottom: 10px;
        margin-left: 15px;
        margin-right: 15px;
        background-color: #f8f9fa;
        /* Optional: Background color for the search bar container */
        border-radius: 8px;
        /* Optional: Rounded corners */
    }

    .search-bar {
        width: 100%;
        max-width: 600px;
        /* Max width to prevent the form from becoming too wide */
        display: flex;
        align-items: center;
        /* Ensure the input and button are vertically aligned */
    }

    .custom-input {
        flex-grow: 1;
        border-radius: 20px 0 0 20px;
        border-right: 0;
        padding: 10px 20px;
        white-space: nowrap;
        /* Prevent text from wrapping */
    }

    .custom-button {
        border-radius: 0 20px 20px 0;
        padding: 10px 20px;
        white-space: nowrap;
        /* Prevent text from wrapping */
    }

    .custom-input:focus {
        outline: none;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        /* Blue shadow to indicate focus */
    }

    .custom-button:hover {
        background-color: #198754;
        /* Darker green on hover */
        color: white;
    }

    @media (max-width: 768px) {
        .search-bar {
            flex-direction: column;
        }

        .custom-input,
        .custom-button {
            border-radius: 20px;
            margin-bottom: 10px;
            width: 100%;
        }

        .custom-button {
            margin-bottom: 0;
        }
    }
</style>
