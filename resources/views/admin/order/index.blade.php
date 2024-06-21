@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản lý đơn hàng</h6>
                        <button type="button" class="btn btn-primary btn-sm" id="quickApproveButton">
                            Duyệt nhanh
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
                                        Người nhận
                                    </th>
                                    {{--                                        <th--}}
                                    {{--                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">--}}
                                    {{--                                            Người duyệt--}}
                                    {{--                                        </th>--}}
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Địa chỉ
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Ngày đặt hàng
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Phương thức thanh toán
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Trạng thái
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
                                        <td id="order-status-{{ $order->id }}">
                                            @switch($order->status)
                                                @case(0)
                                                    <p class="text-xs font-weight-bold mb-0">Chưa duyệt</p>
                                                    @break
                                                @case(1)
                                                    <p class="text-xs font-weight-bold mb-0">Đã duyệt</p>
                                                    @break
                                                @case(2)
                                                    <p class="text-xs font-weight-bold mb-0">Đang giao hàng</p>
                                                    @break
                                                @case(3)
                                                    <p class="text-xs font-weight-bold mb-0">Hoàn thành</p>
                                                    @break
                                                @case(4)
                                                    <p class="text-xs font-weight-bold mb-0">Hủy</p>
                                                    @break
                                                @default
                                                    <p class="text-xs font-weight-bold mb-0">Không xác định</p>
                                            @endswitch
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin-order-detail', $order->id) }}"
                                               class="btn btn-info btn-sm mb-2">
                                                Xem chi tiết
                                            </a>
                                            <button class="btn btn-warning btn-sm mb-2 approve-order-btn"
                                                    data-id="{{ $order->id }}">
                                                Duyệt
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
                                if (statusText === 'Chưa duyệt') {
                                    statusCell.innerHTML = `<p class="text-xs font-weight-bold mb-0">Đã duyệt</p>`
                                }
                            })
                        } else {
                            alert('Có lỗi xảy ra.')
                        }
                    })
                    .catch(error => console.error('Error:', error))
            })
        })

        document.addEventListener('DOMContentLoaded', function () {
            const approveButtons = document.querySelectorAll('.approve-order-btn');

            approveButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const orderId = button.getAttribute('data-id');

                    fetch(`/admin/order/${orderId}`, {
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
                                const statusCell = document.getElementById(`order-status-${orderId}`)
                                let statusText;
                                switch (data.status) {
                                    case 1:
                                        statusText = 'Đã duyệt'
                                        break
                                    case 2:
                                        statusText = 'Đang giao hàng'
                                        break
                                    case 3:
                                        statusText = 'Hoàn thành'
                                        break
                                    case 4:
                                        statusText = 'Hủy'
                                        break
                                    default:
                                        statusText = 'Không xác định'
                                        break
                                }
                                statusCell.innerHTML = `<p class="text-xs font-weight-bold mb-0">${statusText}</p>`
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
