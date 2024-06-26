@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Đơn Hàng</h6>
                        {{-- <button type="button" class="btn btn-primary btn-sm" id="quickApproveButton">
                            Duyệt Nhanh
                        </button> --}}
                    </div>
                    <div class="search-container">
                        <form class="d-flex align-items-center search-bar" method="GET" action="{{ route('admin-order') }}">
                            <input class="form-control form-control-sm custom-input" type="search" name="search"
                                placeholder="Nhập Từ Khóa" aria-label="Tìm kiếm" value="{{ request('search') }}">
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
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Trạng Thái
                                        </th>
                                        <th class="text-secondary opacity-7">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr id="order-{{ $order->id }}">
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
                                                <p class="text-xs font-weight-bold mb-0">{{ $order->paymentMethod->name }}
                                                </p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $order->user ? $order->user->email : 'N/A' }}</p>
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
                                                        <span class="badge badge-sm bg-gradient-warning">Đang Giao Hàng</span>
                                                    @break

                                                    @case(3)
                                                        <span class="badge badge-sm bg-gradient-success">Hoàn Thành</span>
                                                    @break

                                                    @case(4)
                                                        <span class="badge badge-sm bg-gradient-danger">Hủy</span>
                                                    @break

                                                    @default
                                                        <span class="badge badge-sm bg-gradient-faded-dark">Không Xác Định</span>
                                                @endswitch
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('admin-order-detail', $order->id) }}"
                                                    class="btn btn-info btn-sm mb-2">
                                                    Chi Tiết
                                                </a>
                                                <button class="btn btn-warning btn-sm mb-2 approve-order-btn"
                                                    data-id="{{ $order->id }}" data-status="{{ $order->status }}">
                                                    @if ($order->status == 0)
                                                        Duyệt
                                                    @else
                                                        Cập Nhật
                                                    @endif
                                                </button>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('quickApproveButton').addEventListener('click', function() {
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

        document.addEventListener('DOMContentLoaded', function() {
            const approveButtons = document.querySelectorAll('.approve-order-btn');

            approveButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const orderId = button.getAttribute('data-id')
                    const orderStatus = parseInt(button.getAttribute('data-status'))

                    fetch(`/admin/order/${orderId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                status: orderStatus === 0 ? 1 : orderStatus
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const statusCell = document.getElementById(
                                    `order-status-${orderId}`)
                                let statusText;
                                let statusClass;

                                switch (data.status) {
                                    case 1:
                                        statusText = 'Đã Duyệt'
                                        statusClass = 'badge badge-sm bg-gradient-info'
                                        break
                                    case 2:
                                        statusText = 'Đang Giao Hàng'
                                        statusClass = 'badge badge-sm bg-gradient-warning'
                                        break
                                    case 3:
                                        statusText = 'Hoàn Thành'
                                        statusClass = 'badge badge-sm bg-gradient-success'
                                        break
                                    case 4:
                                        statusText = 'Hủy'
                                        statusClass = 'badge badge-sm bg-gradient-danger'
                                        break
                                    default:
                                        statusText = 'Không Xác Định'
                                        statusClass = 'badge badge-sm bg-gradient-faded-dark'
                                        break
                                }
                                statusCell.innerHTML =
                                    `<span class="${statusClass}">${statusText}</span>`
                                if (orderStatus === 0) {
                                    button.innerText = 'Cập Nhật';
                                    button.setAttribute('data-status', 1);
                                } else {
                                    alert('Trạng Thái Đơn Hàng Đã Được Cập Nhật!');
                                }
                            } else {
                                alert(data.message)
                            }
                        })
                        .catch(error => console.error('Error:', error))
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
