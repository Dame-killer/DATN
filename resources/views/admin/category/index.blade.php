@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Danh Mục</h6>
                        @if(Auth()->user()->role == 1)
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addCategoryModal">
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
                                        Tên Danh Mục
                                    </th>
                                    @if(Auth()->user()->role == 1)
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Thao tác
                                        </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $category)
                                    <tr data-bs-toggle="collapse" data-bs-target="#children-{{ $category->id }}"
                                        aria-expanded="false" aria-controls="children-{{ $category->id }}">
                                        <td style="width: 10%;">
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center ms-2">
                                                    {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 20%;">
                                            <p class="text-xs font-weight-bold mb-0">{{ $category->name }}</p>
                                        </td>
                                        @if(Auth()->user()->role == 1)
                                            <td class="align-middle" style="width: 70%;">
                                                <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                        data-bs-target="#editCategoryModal"
                                                        data-id="{{ $category->id }}"
                                                        data-name="{{ $category->name }}">
                                                    Cập Nhật
                                                </button>
                                                <button class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                                        data-bs-target="#deleteCategoryModal"
                                                        data-id="{{ $category->id }}">
                                                    Xóa
                                                </button>
                                                <button class="btn btn-success btn-sm mb-2" data-bs-toggle="modal"
                                                        data-bs-target="#addCategoryModal"
                                                        data-parent-id="{{ $category->id }}">
                                                    Thêm Danh Mục Con
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                    <tr class="collapse" id="children-{{ $category->id }}">
                                        <td colspan="3">
                                            <table class="table align-items-center mb-0">
                                                <tbody>
                                                @foreach ($category->children as $child)
                                                    <tr>
                                                        <td style="width: 10%;">
                                                            <div class="d-flex px-2 py-1">
                                                                <div
                                                                    class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">---</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="width: 20%;">
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                {{ $child->name }}</p>
                                                        </td>
                                                        @if(Auth()->user()->role == 1)
                                                            <td class="align-middle" style="width: 70%;">
                                                                <button class="btn btn-warning btn-sm mb-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editCategoryModal"
                                                                        data-id="{{ $child->id }}"
                                                                        data-name="{{ $child->name }}">
                                                                    Cập Nhật
                                                                </button>
                                                                <button class="btn btn-danger btn-sm mb-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteCategoryModal"
                                                                        data-id="{{ $child->id }}">Xóa
                                                                </button>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $categories->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Thêm Danh Mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm" autocomplete="off">
                        @csrf
                        <input type="hidden" id="parentCategoryId" name="parent_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Danh Mục</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Nhập Tên Danh Mục" required>
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

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Cập Nhật Danh Mục</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCategoryForm" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editCategoryId" name="id">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Tên Danh Mục</label>
                            <input type="text" class="form-control" id="editCategoryName" name="name"
                                   placeholder="Nhập Tên Danh Mục" required>
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

    <!-- Delete Category Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategoryModalLabel">Xác Nhận Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa danh mục này không?
                </div>
                <div class="modal-footer">
                    <form id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteCategoryId" name="id">
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
                    body: JSON.stringify({
                        message: message,
                        type: type
                    })
                }).then(response => {
                    if (response.ok) {
                        location.reload()
                    }
                }).catch(error => {
                    console.error('Lỗi khi gửi thông báo:', error.message)
                })
            }

            function sendAjaxRequest(url, method, formData) {
                return fetch(url, {
                    method: method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData),
                }).then(response => response.json()).catch(error => {
                    console.error('Yêu cầu Ajax không thành công:', error.message)
                })
            }

            var addCategoryModal = document.getElementById('addCategoryModal')
            addCategoryModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var parentId = button ? button.getAttribute('data-parent-id') : null
                var form = document.getElementById('addCategoryForm')
                var modalTitle = addCategoryModal.querySelector('.modal-title')
                var modalBodyInputParentId = addCategoryModal.querySelector('#parentCategoryId')

                modalTitle.textContent = parentId ? 'Thêm Danh Mục Con' : 'Thêm Danh Mục'
                modalBodyInputParentId.value = parentId || ''
                form.action = "{{ route('categories.store') }}"
            })

            document.getElementById('addCategoryForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {
                    parent_id: document.getElementById('parentCategoryId').value,
                    name: document.getElementById('name').value
                }
                sendAjaxRequest(this.action, 'POST', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi thêm danh mục: ', error.message)
                        setFlashMessage('Thêm danh mục thất bại!', 'error')
                    })
            })

            var editCategoryModal = document.getElementById('editCategoryModal')
            editCategoryModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var name = button.getAttribute('data-name')
                var form = document.getElementById('editCategoryForm')

                var modalTitle = editCategoryModal.querySelector('.modal-title')
                var modalBodyInputId = editCategoryModal.querySelector('#editCategoryId')
                var modalBodyInputName = editCategoryModal.querySelector('#editCategoryName')

                modalTitle.textContent = 'Cập Nhật Danh Mục: ' + name
                modalBodyInputId.value = id
                modalBodyInputName.value = name
                form.action = "{{ route('categories.update', '') }}/" + id
            })

            document.getElementById('editCategoryForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {
                    id: document.getElementById('editCategoryId').value,
                    name: document.getElementById('editCategoryName').value
                }
                sendAjaxRequest(this.action, 'PUT', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi cập nhật danh mục: ', error.message)
                        setFlashMessage('Cập nhật danh mục thất bại!', 'error')
                    })
            })

            var deleteCategoryModal = document.getElementById('deleteCategoryModal')
            deleteCategoryModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget
                const id = button.getAttribute('data-id')
                const form = document.getElementById('deleteCategoryForm')

                var modalBodyInputId = deleteCategoryModal.querySelector('#deleteCategoryId')
                modalBodyInputId.value = id
                form.action = "{{ route('categories.destroy', '') }}/" + id
            })

            document.getElementById('deleteCategoryForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {id: document.getElementById('deleteCategoryId').value};
                sendAjaxRequest(this.action, 'DELETE', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi xóa danh mục: ', error.message)
                        setFlashMessage('Xóa danh mục thất bại!', 'error')
                    })
            })
        })
    </script>
@endsection
