@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Chi Tiết Sản Phẩm: {{ $products->code }} - {{ $products->name }}</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addProductDetailModal" data-product-id="{{ $products->id }}">
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
                                            Số Lượng
                                        </th>
                                        <th class="text-secondary opacity-7">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($product_details)
                                        @foreach ($product_details as $product_detail)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $product_detail->size->size_name }}
                                                        -{{ $product_detail->size->size_number }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $product_detail->color->name }}</p>
                                                    <div
                                                        style="width: 20px; height: 20px; background-color: {{ $product_detail->color->code }};">
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $product_detail->quantity }}
                                                    </p>
                                                </td>
                                                <td class="align-middle">
                                                    <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                        data-bs-target="#editProductDetailModal"
                                                        data-id="{{ $product_detail->id }}"
                                                        data-size-id="{{ $product_detail->size->id }}"
                                                        data-color-id="{{ $product_detail->color->id }}"
                                                        data-quantity="{{ $product_detail->quantity }}">
                                                        Cập Nhật
                                                    </button>
                                                    <form
                                                        action="{{ route('product_details.destroy', $product_detail->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button class="btn btn-danger btn-sm" type="submit">Xóa</button>
                                                    </form>
                                                    <form action="{{ route('cart.add', $product_detail->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm" type="submit">
                                                            Thêm Vào Giỏ Hàng
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Chưa Có Sản Phẩm Chi Tiết Nào!</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Detail Modal -->
    <div class="modal fade" id="addProductDetailModal" tabindex="-1" aria-labelledby="addProductDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductDetailModalLabel">Thêm Sản Phẩm Chi Tiết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product_details.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <input type="hidden" id="product_id" name="product_id">
                        <div class="mb-3">
                            <label for="size_id" class="form-label">Kích Cỡ</label>
                            <select class="form-control" id="size_id" name="size_id" required>
                                <option value="">Chọn Kích Cỡ</option>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_name }}
                                        - {{ $size->size_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="color_id" class="form-label">Màu Sắc</label>
                            <select class="form-control" id="color_id" name="color_id" required>
                                <option value="">Chọn Màu Sắc</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số Lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Nhập Số Lượng" required>
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

    <!-- Edit Product Detail Modal -->
    <div class="modal fade" id="editProductDetailModal" tabindex="-1" aria-labelledby="editProductDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductDetailModalLabel">Cập Nhật Sản Phẩm Chi Tiết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('product_details.update', '') }}" method="POST" autocomplete="off"
                        id="editProductDetailForm">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                        <input type="hidden" id="editProductDetailId" name="id">
                        <div class="mb-3">
                            <label for="editSizeId" class="form-label">Kích Cỡ</label>
                            <select class="form-control" id="editSizeId" name="size_id" required>
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_name }}
                                        - {{ $size->size_number }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editColorId" class="form-label">Màu Sắc</label>
                            <select class="form-control" id="editColorId" name="color_id" required>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDetailQuantity" class="form-label">Số Lượng</label>
                            <input type="number" class="form-control" id="editProductDetailQuantity" name="quantity"
                                placeholder="Nhập Số Lượng" required>
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

    <script>
        var addProductDetailModal = document.getElementById('addProductDetailModal')
        addProductDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var productId = button.getAttribute('data-product-id')
            var inputProductId = document.getElementById('product_id')
            inputProductId.value = productId
        })

        var editProductDetailModal = document.getElementById('editProductDetailModal')
        editProductDetailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var size_id = button.getAttribute('data-size-id')
            var color_id = button.getAttribute('data-color-id')
            var quantity = button.getAttribute('data-quantity')
            var form = document.getElementById('editProductDetailForm')

            var modalTitle = editProductDetailModal.querySelector('.modal-title')
            var modalBodyInputId = editProductDetailModal.querySelector('#editProductDetailId')
            var modalBodyInputSizeId = editProductDetailModal.querySelector('#editSizeId')
            var modalBodyInputColorId = editProductDetailModal.querySelector('#editColorId')
            var modalBodyInputQuantity = editProductDetailModal.querySelector('#editProductDetailQuantity')

            modalTitle.textContent = 'Cập Nhật Sản Phẩm Chi Tiết: '
            modalBodyInputId.value = id
            modalBodyInputSizeId.value = size_id
            modalBodyInputColorId.value = color_id
            modalBodyInputQuantity.value = quantity
            form.action = "{{ route('product_details.update', '') }}/" + id
        })
    </script>
@endsection
