@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Đơn Hàng</h6>
                        <button type="button" class="btn btn-primary btn-sm" id="quickApproveButton">
                            Duyệt Nhanh
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
                                    {{--                                        <th--}}
                                    {{--                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">--}}
                                    {{--                                            Mã đơn hàng--}}
                                    {{--                                        </th>--}}
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
                                        Trạng Thái
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
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
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->receiver }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->address }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->order_date }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->paymentMethod->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->user->name }} - {{ $order->user->email }}</p>
                                        </td>
                                        <td id="order-status-{{ $order->id }}">
                                            @switch($order->status)
                                                @case(0)
                                                    <p class="text-xs font-weight-bold mb-0">Chưa Duyệt</p>
                                                    @break
                                                @case(1)
                                                    <p class="text-xs font-weight-bold mb-0">Đã Duyệt</p>
                                                    @break
                                                @case(2)
                                                    <p class="text-xs font-weight-bold mb-0">Đang Giao Hàng</p>
                                                    @break
                                                @case(3)
                                                    <p class="text-xs font-weight-bold mb-0">Hoàn Thành</p>
                                                    @break
                                                @case(4)
                                                    <p class="text-xs font-weight-bold mb-0">Hủy</p>
                                                    @break
                                                @default
                                                    <p class="text-xs font-weight-bold mb-0">Không Xác Định</p>
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin-order-detail', $order->id) }}"
                                               class="btn btn-info btn-sm mb-2">
                                                Xem Chi Tiết
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
                        </div>
                    </div>
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
                                    statusCell.innerHTML = `<p class="text-xs font-weight-bold mb-0">Đã Duyệt</p>`
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
            const approveButtons = document.querySelectorAll('.approve-order-btn');

            approveButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = button.getAttribute('data-id')
                    const orderStatus = parseInt(button.getAttribute('data-status'))

                    fetch(`/admin/order/${orderId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({status: orderStatus === 0 ? 1 : orderStatus})
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const statusCell = document.getElementById(`order-status-${orderId}`)
                                let statusText;
                                switch (data.status) {
                                    case 1:
                                        statusText = 'Đã Duyệt'
                                        break
                                    case 2:
                                        statusText = 'Đang Giao Hàng'
                                        break
                                    case 3:
                                        statusText = 'Hoàn Thành'
                                        break
                                    case 4:
                                        statusText = 'Hủy'
                                        break
                                    default:
                                        statusText = 'Không Xác Định'
                                        break
                                }
                                statusCell.innerHTML = `<p class="text-xs font-weight-bold mb-0">${statusText}</p>`
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
