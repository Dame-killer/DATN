@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Nhân Viên</h6>
                        @if(Auth()->user()->role == 1)
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addEmployeeModal">
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
                                        Tên Nhân Viên
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Số Điện Thoại
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Quyền
                                    </th>
                                    @if(Auth()->user()->role == 1)
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Thao
                                            tác
                                        </th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm ms-2">{{ $loop->iteration }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $user->phone }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">
                                                @if ($user->role == 1)
                                                    Quản Lý
                                                @elseif ($user->role == 2)
                                                    Nhân Viên
                                                @endif
                                            </p>
                                        </td>
                                        @if(Auth()->user()->role == 1)
                                            <td class="align-middle">
                                                <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                        data-bs-target="#editEmployeeModal" data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                                        data-phone="{{ $user->phone }}" data-role="{{ $user->role }}">
                                                    Cập Nhật
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm mb-2"
                                                        data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal"
                                                        data-id="{{ $user->id }}">
                                                    Xóa
                                                </button>
                                            </td>
                                        @endif
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

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Thêm Nhân Viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Nhân Viên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Nhập Tên Nhân Viên" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập Email"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật Khẩu</label>
                            <input type="password" minlength="8" class="form-control" id="password" name="password"
                                   placeholder="Nhập Mật Khẩu" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số Điện Thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   placeholder="Nhập Số Điện Thoại" maxlength="11" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Quyền</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Chọn Quyền</option>
                                <option value="1">Quản Lý</option>
                                <option value="2">Nhân Viên</option>
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

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Cập Nhật Nhân Viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editEmployeeId" name="id">
                        <div class="mb-3">
                            <label for="editEmployeeName" class="form-label">Tên Nhân Viên</label>
                            <input type="text" class="form-control" id="editEmployeeName" name="name"
                                   placeholder="Nhập Tên Nhân Viên" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmployeeEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmployeeEmail" name="email"
                                   placeholder="Nhập Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmployeePhone" class="form-label">Số Điện Thoại</label>
                            <input type="tel" class="form-control" id="editEmployeePhone" name="phone"
                                   placeholder="Nhập Số Điện Thoại" maxlength="11" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmployeeRole" class="form-label">Quyền</label>
                            <select class="form-control" id="editEmployeeRole" name="role" required>
                                <option value="1">Quản Lý</option>
                                <option value="2">Nhân Viên</option>
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

    <!-- Delete Employee Modal -->
    <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEmployeeModalLabel">Xác Nhận Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa người dùng này không?
                </div>
                <div class="modal-footer">
                    <form id="deleteEmployeeForm">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deleteEmployeeId" name="id">
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

            document.getElementById('addEmployeeForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    phone: document.getElementById('phone').value,
                    role: document.getElementById('role').value
                }
                sendAjaxRequest('{{ route('users.store') }}', 'POST', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi thêm người dùng: ', error.message)
                        setFlashMessage('Thêm người dùng thất bại!', 'error')
                    })
            })

            var editEmployeeModal = document.getElementById('editEmployeeModal')
            editEmployeeModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var name = button.getAttribute('data-name')
                var email = button.getAttribute('data-email')
                var phone = button.getAttribute('data-phone')
                var role = button.getAttribute('data-role')
                var form = document.getElementById('editEmployeeForm')

                var modalTitle = editEmployeeModal.querySelector('.modal-title')
                var modalBodyInputId = editEmployeeModal.querySelector('#editEmployeeId')
                var modalBodyInputName = editEmployeeModal.querySelector('#editEmployeeName')
                var modalBodyInputEmail = editEmployeeModal.querySelector('#editEmployeeEmail')
                var modalBodyInputPhone = editEmployeeModal.querySelector('#editEmployeePhone')
                var modalBodySelectRole = editEmployeeModal.querySelector('#editEmployeeRole')

                modalTitle.textContent = 'Cập Nhật Nhân Viên: ' + name
                modalBodyInputId.value = id
                modalBodyInputName.value = name
                modalBodyInputEmail.value = email
                modalBodyInputPhone.value = phone
                modalBodySelectRole.value = role
                form.action = "{{ route('users.update', '') }}/" + id
            })

            document.getElementById('editEmployeeForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {
                    id: document.getElementById('editEmployeeId').value,
                    name: document.getElementById('editEmployeeName').value,
                    email: document.getElementById('editEmployeeEmail').value,
                    phone: document.getElementById('editEmployeePhone').value,
                    role: document.getElementById('editEmployeeRole').value
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
                        console.error('Lỗi khi cập nhật người dùng: ', error.message)
                        setFlashMessage('Cập nhật người dùng thất bại!', 'error')
                    })
            })

            var deleteEmployeeModal = document.getElementById('deleteEmployeeModal')
            deleteEmployeeModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var form = document.getElementById('deleteEmployeeForm')

                var modalBodyInputId = deleteEmployeeModal.querySelector('#deleteEmployeeId')
                modalBodyInputId.value = id
                form.action = "{{ route('users.destroy', '') }}/" + id
            })

            document.getElementById('deleteEmployeeForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {id: document.getElementById('deleteEmployeeId').value};
                sendAjaxRequest(this.action, 'DELETE', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi xóa người dùng: ', error.message)
                        setFlashMessage('Xóa người dùng thất bại!', 'error')
                    })
            })

            document.getElementById('phone').addEventListener('input', function (event) {
                this.value = this.value.replace(/[^0-9]/g, '')
            })

            document.getElementById('editEmployeePhone').addEventListener('input', function (event) {
                this.value = this.value.replace(/[^0-9]/g, '')
            })
        })
    </script>
@endsection
