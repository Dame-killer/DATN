@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Sản Phẩm</h6>
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
                                        Giá
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Mô Tả
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Danh Mục
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Thương Hiệu
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $product->code }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $product->name }}</p>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                 alt="{{ $product->name }}" class="img-fluid"
                                                 style="width: 50px; height: 50px;">
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ number_format($product->price) }}đ</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $product->introduce }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $product->category->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $product->brand->name }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin-product-detail', $product->id) }}"
                                               class="btn btn-info btn-sm mb-2">
                                                Chi Tiết
                                            </a>
                                            <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#editProductModal" data-id="{{ $product->id }}"
                                                    data-code="{{ $product->code }}" data-name="{{ $product->name }}"
                                                    data-image="{{ asset('storage/' . $product->image) }}"
                                                    data-price="{{ $product->price }}"
                                                    data-introduce="{{ $product->introduce }}"
                                                    data-category="{{ $product->category->id }}"
                                                    data-brand="{{ $product->brand->id }}">
                                                Cập Nhật
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm mb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteProductModal" data-id="{{ $product->id }}">
                                                Xóa
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Thêm Sản Phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.store') }}" method="POST" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Nhập Tên Sản Phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình Ảnh</label>
                            <img id="previewImage" src="#" alt="Hình Ảnh Xem Trước" class="img-fluid mb-2"
                                 style="width: 50px; height: 50px; display: none;">
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="price" name="price"
                                   placeholder="Nhập Giá Sản Phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="introduce" class="form-label">Mô Tả</label>
                            <input type="text" class="form-control" id="introduce" name="introduce"
                                   placeholder="Nhập Mô Tả Sản Phẩm">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Danh Mục</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Chọn Danh Mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Thương Hiệu</label>
                            <select class="form-control" id="brand_id" name="brand_id" required>
                                <option value="">Chọn Thương Hiệu</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Cập Nhật Sản Phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.update', '') }}" method="POST" autocomplete="off"
                          id="editProductForm" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="editProductId" name="id">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Tên Sản Phẩm</label>
                            <input type="text" class="form-control" id="editProductName" name="name"
                                   placeholder="Nhập Tên Sản Phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage" class="form-label">Hình Ảnh</label>
                            <img id="currentProductImage" src="" alt="Current Product Image"
                                 class="img-fluid mb-2" style="width: 50px; height: 50px;">
                            <input type="file" class="form-control" id="editProductImage" name="image">
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Giá</label>
                            <input type="number" class="form-control" id="editProductPrice" name="price"
                                   placeholder="Nhập Giá Sản Phẩm" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductIntroduce" class="form-label">Mô Tả</label>
                            <input type="text" class="form-control" id="editProductIntroduce" name="introduce"
                                   placeholder="Nhập Mô Tả Sản Phẩm">
                        </div>
                        <div class="mb-3">
                            <label for="editProductCategory" class="form-label">Danh Mục</label>
                            <select class="form-control" id="editProductCategory" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editProductBrand" class="form-label">Thương Hiệu</label>
                            <select class="form-control" id="editProductBrand" name="brand_id" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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

    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Xác Nhận Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa sản phẩm này không?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('products.destroy', '') }}" id="deleteProductForm" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var editProductModal = document.getElementById('editProductModal')
        editProductModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var name = button.getAttribute('data-name')
            var image = button.getAttribute('data-image')
            var price = button.getAttribute('data-price')
            var introduce = button.getAttribute('data-introduce')
            var category = button.getAttribute('data-category')
            var brand = button.getAttribute('data-brand')
            var form = document.getElementById('editProductForm')

            var modalTitle = editProductModal.querySelector('.modal-title')
            var modalBodyInputId = editProductModal.querySelector('#editProductId')
            var modalBodyInputName = editProductModal.querySelector('#editProductName')
            var modalBodyInputImage = editProductModal.querySelector('#editProductImage')
            var modalBodyInputCurrentImage = editProductModal.querySelector('#currentProductImage')
            var modalBodyInputPrice = editProductModal.querySelector('#editProductPrice')
            var modalBodyInputIntroduce = editProductModal.querySelector('#editProductIntroduce')
            var modalBodyInputCategory = editProductModal.querySelector('#editProductCategory')
            var modalBodyInputBrand = editProductModal.querySelector('#editProductBrand')

            modalTitle.textContent = 'Cập Nhật Sản Phẩm: ' + name
            modalBodyInputId.value = id
            modalBodyInputName.value = name
            modalBodyInputCurrentImage.src = image
            modalBodyInputPrice.value = price
            modalBodyInputIntroduce.value = introduce
            modalBodyInputCategory.value = category
            modalBodyInputBrand.value = brand
            form.action = "{{ route('products.update', '') }}/" + id
        })

        document.getElementById("image").addEventListener("change", function (event) {
            var previewImage = document.getElementById('previewImage')
            var file = event.target.files[0]
            var reader = new FileReader()

            reader.onload = function (e) {
                previewImage.src = e.target.result
                previewImage.style.display = 'block'
            };

            if (file) {
                reader.readAsDataURL(file)
            }
        })

        document.addEventListener('DOMContentLoaded', function () {
            var deleteProductModal = document.getElementById('deleteProductModal')
            deleteProductModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var form = document.getElementById('deleteProductForm')
                form.action = "{{ route('products.destroy', '') }}/" + id
            })
        })
    </script>
@endsection
