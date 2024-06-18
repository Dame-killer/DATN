@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản lý đơn hàng</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addProductModal">
                            Thêm
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
                                        <tr>
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
                                                <p class="text-xs font-weight-bold mb-0">{{ $order->payment_method_id }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $order->status }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <a href="{{ route('admin-order-detail', $order->id) }}"
                                                   class="btn btn-info btn-sm mb-2">
                                                    Xem chi tiết
                                                </a>
                                                <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#editProductModal" data-id="{{ $order->id }}"
                                                    data-name="{{ $order->name }}">
                                                    Cập nhật
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

    <!-- Add Payment Method Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Thêm đơn hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('orders.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Mã</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Người nhận</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Người duyệt</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="image" name="name"
                                placeholder="Nhập ảnh quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Ngày đặt hàng</label>
                            <input type="text" class="form-control" id="brand" name="name"
                                placeholder="Nhập ảnh quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Phương thức thanh toán</label>
                            <input type="text" class="form-control" id="brand" name="name"
                                placeholder="Nhập ảnh quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" id="brand" name="name"
                                placeholder="Nhập ảnh quần áo" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Payment Method Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Cập nhật quần áo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.update', '') }}" method="POST" autocomplete="off"
                        id="editProductForm">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="editProductId" name="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Mã</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Người nhận</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Người duyệt</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="image" name="name"
                                placeholder="Nhập ảnh quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Ngày đặt hàng</label>
                            <input type="text" class="form-control" id="brand" name="name"
                                placeholder="Nhập ảnh quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Phương thức thanh toán</label>
                            <input type="text" class="form-control" id="brand" name="name"
                                placeholder="Nhập ảnh quần áo" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" id="brand" name="name"
                                placeholder="Nhập ảnh quần áo" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var editProductModal = document.getElementById('editProductModal')
        editProductModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var name = button.getAttribute('data-name')
            var form = document.getElementById('editProductForm');

            var modalTitle = editProductModal.querySelector('.modal-title')
            var modalBodyInputId = editProductModal.querySelector('#editProductId')
            var modalBodyInputName = editProductModal.querySelector('#editProductName')

            modalTitle.textContent = 'Cập nhậtquần áo: ' + name
            modalBodyInputId.value = id
            modalBodyInputName.value = name
            form.action = "{{ route('products.update', '') }}/" + id;
        })
    </script>
@endsection
