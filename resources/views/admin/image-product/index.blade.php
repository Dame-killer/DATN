@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Hình Ảnh</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addImageProductModal">
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
                                            Mã Sản Phẩm
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tên Sản Phẩm
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Hình Ảnh
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Màu Sắc
                                        </th>
                                        <th class="text-secondary opacity-7">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($imageProducts as $imageProduct)
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
                                                    {{ $imageProduct->productDetail->product->code }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $imageProduct->productDetail->product->name }}</p>
                                            </td>
                                            <td>
                                                <img src="{{ asset('storage/' . $imageProduct->url) }}" alt=""
                                                    class="img-fluid" style="width: 50px; height: 50px;">
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    {{ $imageProduct->productDetail->color->name }}</p>
                                                <div
                                                    style="width: 20px; height: 20px; background-color: {{ $imageProduct->productDetail->color->code }};">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#editImageProductModal"
                                                    data-id="{{ $imageProduct->id }}"
                                                    data-url="{{ asset('storage/' . $imageProduct->url) }}"
                                                    data-product-detail="{{ $imageProduct->product_detail_id }}">
                                                    Cập Nhật
                                                </button>
                                                <form action="{{ route('image_products.destroy', $imageProduct->id) }}"
                                                    method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit">Xóa</button>
                                                </form>
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

    <!-- Add Image Product Modal -->
    <div class="modal fade" id="addImageProductModal" tabindex="-1" aria-labelledby="addImageProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageProductModalLabel">Thêm Ảnh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('image_products.store') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for=url>Chọn Hình Ảnh</label>
                            <img id="previewImage" src="#" alt="Preview Image" class="img-fluid mb-2"
                                style="width: 50px; height: 50px; display: none;">
                            <input type="file" class="form-control" id="url" name="url" required>
                        </div>
                        <div class="form-group">
                            <label for="productDetailId">Chọn Sản Phẩm</label>
                            <select class="form-control" id="productDetailId" name="product_detail_id" required>
                                <option value="">Chọn Sản Phẩm</option>
                                @foreach ($productDetails as $productDetail)
                                    <option value="{{ $productDetail->id }}">{{ $productDetail->product->code }}
                                        - {{ $productDetail->product->name }}
                                        - {{ $productDetail->color->name }}
                                    </option>
                                @endforeach
                            </select>
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

    <!-- Edit Image Product Modal -->
    <div class="modal fade" id="editImageProductModal" tabindex="-1" aria-labelledby="editImageProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editImageProductModalLabel">Cập Nhật Ảnh</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('image_products.update', '') }}" method="POST" autocomplete="off"
                        id="editImageProductForm" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="editImageProductId" name="id">
                        <div class="form-group">
                            <label for="editUrl">Chọn Hình Ảnh</label>
                            <img id="currentProductImage" src="" alt="Current Product Image"
                                class="img-fluid mb-2" style="width: 50px; height: 50px;">
                            <input type="file" class="form-control" id="editUrl" name="url">
                        </div>
                        <div class="form-group">
                            <label for="editProductDetailId">Chọn Sản Phẩm</label>
                            <select class="form-control" id="editProductDetailId" name="product_detail_id" required>
                                @foreach ($productDetails as $productDetail)
                                    <option value="{{ $productDetail->id }}">{{ $productDetail->product->code }}
                                        - {{ $productDetail->product->name }}
                                        - {{ $productDetail->color->name }}
                                    </option>
                                @endforeach
                            </select>
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
        var editImageProductModal = document.getElementById('editImageProductModal')
        editImageProductModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var url = button.getAttribute('data-url')
            var productDetail = button.getAttribute('data-product-detail')
            var form = document.getElementById('editImageProductForm')

            var modalTitle = editImageProductModal.querySelector('.modal-title')
            var modalBodyInputId = editImageProductModal.querySelector('#editImageProductId')
            var modalBodyInputUrl = editImageProductModal.querySelector('#editUrl')
            var modalBodyInputCurrentImage = editImageProductModal.querySelector('#currentProductImage')
            var modalBodyInputProductDetail = editImageProductModal.querySelector('#editProductDetailId')

            modalTitle.textContent = 'Cập Nhật Ảnh: '
            modalBodyInputId.value = id
            modalBodyInputCurrentImage.src = url
            modalBodyInputProductDetail.value = productDetail
            form.action = "{{ route('image_products.update', '') }}/" + id
        })

        document.getElementById("url").addEventListener("change", function(event) {
            var previewImage = document.getElementById('previewImage')
            var file = event.target.files[0]
            var reader = new FileReader()

            reader.onload = function(e) {
                previewImage.src = e.target.result
                previewImage.style.display = 'block'
            };

            if (file) {
                reader.readAsDataURL(file)
            }
        })
    </script>
@endsection
