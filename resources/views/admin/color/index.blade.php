@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Màu Sắc</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addColorModal">
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
                                            Tên Màu Sắc
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Màu Sắc
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colors as $color)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ ($colors->currentPage() - 1) * $colors->perPage() + $loop->iteration }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $color->name }}</p>
                                            </td>
                                            <td>
                                                <div
                                                    style="width: 20px; height: 20px; background-color: {{ $color->code }};">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#editColorModal" data-id="{{ $color->id }}"
                                                    data-name="{{ $color->name }}" data-code="{{ $color->code }}">
                                                    Cập Nhật
                                                </button>
                                                <button class="btn btn-danger btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#deleteColorModal" data-id="{{ $color->id }}">
                                                    Xóa
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $colors->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Color Modal -->
    <div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addColorModalLabel">Thêm Màu Sắc</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('colors.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Màu Sắc</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập Tên Màu Sắc" required>
                        </div>
                        <div class="mb-3">
                            <label for="code" class="form-label">Mã Màu</label>
                            <input type="color" class="form-control" id="code" name="code" required>
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

    <!-- Edit Color Modal -->
    <div class="modal fade" id="editColorModal" tabindex="-1" aria-labelledby="editColorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editColorModalLabel">Cập Nhật Màu Sắc</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('colors.update', '') }}" method="POST" autocomplete="off" id="editColorForm">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="editColorId" name="id">
                        <div class="mb-3">
                            <label for="editColorName" class="form-label">Tên Màu Sắc</label>
                            <input type="text" class="form-control" id="editColorName" name="name"
                                placeholder="Nhập Tên Màu Sắc" required>
                        </div>
                        <div class="mb-3">
                            <label for="editColorCode" class="form-label">Mã Màu</label>
                            <input type="color" class="form-control" id="editColorCode" name="code" required>
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

    <!-- Delete Color Modal -->
    <div class="modal fade" id="deleteColorModal" tabindex="-1" aria-labelledby="deleteColorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteColorModalLabel">Xác Nhận Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa màu sắc này không?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('colors.destroy', '') }}" id="deleteColorForm" method="POST">
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
        var editColorModal = document.getElementById('editColorModal')
        editColorModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var name = button.getAttribute('data-name')
            var code = button.getAttribute('data-code')
            var form = document.getElementById('editColorForm')

            var modalTitle = editColorModal.querySelector('.modal-title')
            var modalBodyInputId = editColorModal.querySelector('#editColorId')
            var modalBodyInputName = editColorModal.querySelector('#editColorName')
            var modalBodyInputCode = editColorModal.querySelector('#editColorCode')

            modalTitle.textContent = 'Cập Nhật Màu Sắc: ' + name
            modalBodyInputId.value = id
            modalBodyInputName.value = name
            modalBodyInputCode.value = code
            form.action = "{{ route('colors.update', '') }}/" + id
        })

        document.addEventListener('DOMContentLoaded', function() {
            const deleteColorModal = document.getElementById('deleteColorModal')
            deleteColorModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget
                const id = button.getAttribute('data-id')
                const form = document.getElementById('deleteColorForm')
                form.action = "{{ route('colors.destroy', '') }}/" + id
            })
        })
    </script>
@endsection
