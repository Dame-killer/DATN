@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Hình Ảnh</h6>
                        @if(Auth()->user()->role == 1)
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addImageProductModal">
                                Thêm
                            </button>
                        @endif
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
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hình Ảnh
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Màu Sắc
                                    </th>
                                    @if(Auth()->user()->role == 1)
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Thao tác
                                        </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($imageProducts as $imageProduct)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm ms-2">
                                                        {{ ($imageProducts->currentPage() - 1) * $imageProducts->perPage() + $loop->iteration }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $imageProduct->productDetail->product->code }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $imageProduct->productDetail->product->name }}</p>
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/' . $imageProduct->url) }}"
                                                 alt="" class="img-fluid"
                                                 style="width: 50px; height: 50px;">
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $imageProduct->productDetail->color->name }}</p>
                                            <div
                                                style="width: 20px; height: 20px; background-color: {{ $imageProduct->productDetail->color->code }}; border: 1px solid #000;">
                                            </div>
                                        </td>
                                        @if(Auth()->user()->role == 1)
                                            <td class="align-middle">
                                                <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                        data-bs-target="#editImageProductModal"
                                                        data-id="{{ $imageProduct->id }}"
                                                        data-url="{{ asset('storage/' . $imageProduct->url) }}"
                                                        data-product-detail="{{ $imageProduct->product_detail_id }}"
                                                        data-product-id="{{ $imageProduct->productDetail->product_id }}"
                                                        data-color-id="{{ $imageProduct->productDetail->color_id }}">
                                                    Cập Nhật
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm mb-2"
                                                        data-bs-toggle="modal" data-bs-target="#deleteImageProductModal"
                                                        data-id="{{ $imageProduct->id }}">
                                                    Xóa
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $imageProducts->appends(request()->query())->links() }}
                            </div>
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
                    <form id="addImageProductForm" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for=url>Chọn Hình Ảnh</label>
                            <img id="previewImage" src="#" alt="Preview Image" class="img-fluid mb-2"
                                 style="width: 50px; height: 50px; display: none;">
                            <input type="file" class="form-control" id="url" name="url" required>
                        </div>
                        <div class="form-group">
                            <label for="productId">Chọn Sản Phẩm</label>
                            <select class="form-control" id="productId" name="product_id" required>
                                <option value="">Chọn Sản Phẩm</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->code }}
                                        - {{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="colorId">Chọn Màu Sắc</label>
                            <select class="form-control" id="colorId" name="color_id" required>
                                <option value="">Chọn Màu Sắc</option>
                                <!-- Options will be dynamically populated -->
                            </select>
                        </div>
                        <input type="hidden" id="productDetailId" name="product_detail_id">
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
                    <form id="editImageProductForm" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editImageProductId" name="id">
                        <div class="form-group">
                            <label for="editUrl" class="form-label">Chọn Hình Ảnh</label>
                            <img id="currentProductImage" src="" alt="Current Product Image" class="img-fluid mb-2"
                                 style="width: 50px; height: 50px;">
                            <input type="file" class="form-control" id="editUrl" name="url">
                        </div>
                        <div class="mb-3">
                            <label for="editProductId" class="form-label">Chọn Sản Phẩm</label>
                            <select class="form-control" id="editProductId" name="product_id" required>
                                <option value="">Chọn Sản Phẩm</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->code }}
                                        - {{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editColorId" class="form-label">Chọn Màu Sắc</label>
                            <select class="form-control" id="editColorId" name="color_id" required>
                                <option value="">Chọn Màu Sắc</option>
                            </select>
                        </div>
                        <input type="hidden" id="editProductDetailId" name="product_detail_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Image Product Modal -->
    <div class="modal fade" id="deleteImageProductModal" tabindex="-1" aria-labelledby="deleteImageProductModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteImageProductModalLabel">Xác Nhận Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa hình ảnh sản phẩm này không?
                </div>
                <div class="modal-footer">
                    <form id="deleteImageProductForm">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteImageProductId" name="id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function setFlashMessage(message, type) {
                fetch('{{ route('flash-message') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({message, type})
                })
                    .then(response => {
                        if (response.ok) {
                            location.reload()
                        }
                    })
                    .catch(error => console.error('Lỗi khi gửi thông báo:', error.message))
            }

            function sendAjaxRequest(url, method, formData) {
                return fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                    .then(response => response.json())
                    .catch(error => console.error('Yêu cầu Ajax không thành công:', error.message))
            }

            function populateColorOptions(element, productId, selectedColorId = null) {
                fetch("{{ route('admin-get-detail', '') }}/" + productId)
                    .then(response => response.json())
                    .then(data => {
                        element.innerHTML = '<option value="">Chọn Màu Sắc</option>'
                        let colorSet = new Set()
                        data.forEach(productDetail => {
                            colorSet.add(productDetail.color_id)
                        })
                        Array.from(colorSet).forEach(colorId => {
                            let productDetail = data.find(detail => detail.color_id == colorId)
                            let option = document.createElement('option')
                            option.value = productDetail.color_id
                            option.textContent = productDetail.color_name
                            element.appendChild(option)
                        })
                        if (selectedColorId) {
                            element.value = selectedColorId
                            element.dispatchEvent(new Event('change'))
                        }
                    })
                    .catch(error => console.error('Lỗi khi lấy chi tiết sản phẩm:', error.message))
            }

            function handleProductIdChange(productId, colorSelect, productDetailIdInput) {
                colorSelect.innerHTML = '' // Clear options
                if (productId) {
                    populateColorOptions(colorSelect, productId)
                } else {
                    productDetailIdInput.value = ''
                }
            }

            function handleColorIdChange(productId, colorId, productDetailIdInput) {
                if (productId && colorId) {
                    fetch("{{ route('admin-get-detail', '') }}/" + productId)
                        .then(response => response.json())
                        .then(data => {
                            let productDetail = data.find(detail => detail.color_id == colorId)
                            productDetailIdInput.value = productDetail ? productDetail.id : ''
                        })
                        .catch(error => console.error('Lỗi khi lấy chi tiết sản phẩm:', error.message))
                } else {
                    productDetailIdInput.value = ''
                }
            }

            document.getElementById('productId').addEventListener('change', function () {
                var productId = this.value
                var colorSelect = document.getElementById('colorId')
                var productDetailIdInput = document.getElementById('productDetailId')
                handleProductIdChange(productId, colorSelect, productDetailIdInput)
            })

            document.getElementById('colorId').addEventListener('change', function () {
                var productId = document.getElementById('productId').value
                var colorId = this.value
                var productDetailIdInput = document.getElementById('productDetailId')
                handleColorIdChange(productId, colorId, productDetailIdInput)
            })

            document.getElementById('editProductId').addEventListener('change', function () {
                var productId = this.value
                var colorSelect = document.getElementById('editColorId')
                var productDetailIdInput = document.getElementById('editProductDetailId')
                handleProductIdChange(productId, colorSelect, productDetailIdInput)
            })

            document.getElementById('editColorId').addEventListener('change', function () {
                var productId = document.getElementById('editProductId').value
                var colorId = this.value
                var productDetailIdInput = document.getElementById('editProductDetailId')
                handleColorIdChange(productId, colorId, productDetailIdInput)
            })

            document.getElementById('addImageProductForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = new FormData(this)
                sendAjaxRequest('{{ route('image_products.store') }}', 'POST', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi thêm hình ảnh sản phẩm: ', error.message)
                        setFlashMessage('Thêm hình ảnh sản phẩm thất bại!', 'error')
                    })
            })

            var editImageProductModal = document.getElementById('editImageProductModal')
            editImageProductModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var url = button.getAttribute('data-url')
                var productDetailId = button.getAttribute('data-product-detail-id')
                var productId = button.getAttribute('data-product-id')
                var colorId = button.getAttribute('data-color-id')

                var form = document.getElementById('editImageProductForm')
                var modalTitle = editImageProductModal.querySelector('.modal-title')
                var modalBodyInputId = editImageProductModal.querySelector('#editImageProductId')
                var modalBodyInputUrl = editImageProductModal.querySelector('#editUrl')
                var modalBodyInputCurrentImage = editImageProductModal.querySelector('#currentProductImage')
                var modalBodyInputProductId = editImageProductModal.querySelector('#editProductId')
                var modalBodyInputColorId = editImageProductModal.querySelector('#editColorId')
                var modalBodyInputProductDetailId = editImageProductModal.querySelector('#editProductDetailId')

                modalTitle.textContent = 'Cập Nhật Ảnh'
                modalBodyInputId.value = id
                modalBodyInputUrl.value = ''
                modalBodyInputCurrentImage.src = url
                modalBodyInputProductId.value = productId
                modalBodyInputColorId.setAttribute('data-current-color-id', colorId)
                modalBodyInputProductDetailId.value = productDetailId

                form.action = "{{ route('image_products.update', '') }}/" + id

                // Trigger change event to load colors
                var event = new Event('change')
                modalBodyInputProductId.dispatchEvent(event)
            });

            document.getElementById('editImageProductForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = new FormData(this)
                sendAjaxRequest(this.action, 'POST', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi cập nhật hình ảnh sản phẩm: ', error.message)
                        setFlashMessage('Cập nhật hình ảnh sản phẩm thất bại!', 'error')
                    })
            })

            var deleteImageProductModal = document.getElementById('deleteImageProductModal')
            document.getElementById('deleteImageProductModal').addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var form = document.getElementById('deleteImageProductForm')

                var modalBodyInputId = deleteImageProductModal.querySelector('#deleteImageProductId')
                modalBodyInputId.value = id
                form.action = "{{ route('image_products.destroy', '') }}/" + id
            })

            document.getElementById('deleteImageProductForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = new FormData(this)
                sendAjaxRequest(this.action, 'DELETE', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi xóa hình ảnh sản phẩm: ', error.message)
                        setFlashMessage('Xóa hình ảnh sản phẩm thất bại!', 'error')
                    })
            })

            document.getElementById("url").addEventListener("change", function (event) {
                var previewImage = document.getElementById('previewImage')
                var file = event.target.files[0]
                var reader = new FileReader()

                reader.onload = function (e) {
                    previewImage.src = e.target.result
                    previewImage.style.display = 'block'
                }

                if (file) {
                    reader.readAsDataURL(file)
                }
            })

            document.getElementById('editUrl').addEventListener('change', function () {
                var file = this.files[0]
                var reader = new FileReader()
                var modalBodyInputCurrentImage = editImageProductModal.querySelector('#currentProductImage')

                reader.onload = function (e) {
                    modalBodyInputCurrentImage.src = e.target.result
                }

                reader.readAsDataURL(file)
            })
        })
    </script>
@endsection
