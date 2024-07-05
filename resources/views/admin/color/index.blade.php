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
                                                style="width: 20px; height: 20px; background-color: {{ $color->code }}; border: 1px solid #000;">
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
                    <form id="addColorForm" autocomplete="off">
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
                    <form id="editColorForm" autocomplete="off">
                        @csrf
                        @method('PUT')
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
                    <form id="deleteColorForm">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteColorId" name="id">
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

            document.getElementById('addColorForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {
                    name: document.getElementById('name').value,
                    code: document.getElementById('code').value
                }
                sendAjaxRequest('{{ route('colors.store') }}', 'POST', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi thêm màu sắc: ', error.message)
                        setFlashMessage('Thêm màu sắc thất bại!', 'error')
                    })
            })

            var editColorModal = document.getElementById('editColorModal')
            editColorModal.addEventListener('show.bs.modal', function (event) {
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

            document.getElementById('editColorForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {
                    id: document.getElementById('editColorId').value,
                    name: document.getElementById('editColorName').value,
                    code: document.getElementById('editColorCode').value
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
                        console.error('Lỗi khi cập nhật màu sắc: ', error.message)
                        setFlashMessage('Cập nhật màu sắc thất bại!', 'error')
                    })
            })

            var deleteColorModal = document.getElementById('deleteColorModal')
            deleteColorModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget
                const id = button.getAttribute('data-id')
                const form = document.getElementById('deleteColorForm')

                var modalBodyInputId = deleteColorModal.querySelector('#deleteColorId')
                modalBodyInputId.value = id
                form.action = "{{ route('colors.destroy', '') }}/" + id
            })

            document.getElementById('deleteColorForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = { id: document.getElementById('deleteColorId').value }
                sendAjaxRequest(this.action, 'DELETE', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi xóa màu sắc: ', error.message)
                        setFlashMessage('Xóa màu sắc thất bại!', 'error')
                    })
            })
        })
    </script>
@endsection
