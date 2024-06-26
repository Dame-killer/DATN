@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Danh Mục</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addCategoryModal">
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
                                        Tên Danh Mục
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $category)
                                    <tr data-bs-toggle="collapse" data-bs-target="#children-{{ $category->id }}"
                                        aria-expanded="false" aria-controls="children-{{ $category->id }}">
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $category->name }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryModal" data-id="{{ $category->id }}"
                                                    data-name="{{ $category->name }}">
                                                Cập Nhật
                                            </button>
                                            <button class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCategoryModal" data-id="{{ $category->id }}">
                                                Xóa
                                            </button>
                                            <button class="btn btn-success btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#addCategoryModal"
                                                    data-parent-id="{{ $category->id }}">
                                                Thêm Danh Mục Con
                                            </button>
                                        </td>
                                    </tr>
                                    <tr class="collapse" id="children-{{ $category->id }}">
                                        <td colspan="3">
                                            <table class="table align-items-center mb-0">
                                                <tbody>
                                                @foreach ($category->children as $child)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-2 py-1">
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">{{ $child->name }}</p>
                                                        </td>
                                                        <td class="align-middle">
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
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
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
                    <form action="{{ route('categories.store') }}" method="POST" autocomplete="off"
                          id="addCategoryForm">
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
                    <form action="{{ route('categories.update', '') }}" method="POST" autocomplete="off"
                          id="editCategoryForm">
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
                    <form action="{{ route('categories.destroy', '') }}" id="deleteCategoryForm" method="POST">
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

        document.addEventListener('DOMContentLoaded', function () {
            const deleteCategoryModal = document.getElementById('deleteCategoryModal')
            deleteCategoryModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget
                const id = button.getAttribute('data-id')
                const form = document.getElementById('deleteCategoryForm')
                form.action = "{{ route('categories.destroy', '') }}/" + id
            })
        })
    </script>
@endsection
