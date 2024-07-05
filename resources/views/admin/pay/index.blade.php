@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Quản Lý Phương Thức Thanh Toán</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addPaymentMethodModal">
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
                                        Tên Phương Thức Thanh Toán
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($payment_methods as $payment_method)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $payment_method->name }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#editPaymentMethodModal"
                                                    data-id="{{ $payment_method->id }}"
                                                    data-name="{{ $payment_method->name }}">
                                                Cập Nhật
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm mb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deletePaymentMethodModal"
                                                    data-id="{{ $payment_method->id }}">
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

    <!-- Add Payment Method Modal -->
    <div class="modal fade" id="addPaymentMethodModal" tabindex="-1" aria-labelledby="addPaymentMethodModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentMethodModalLabel">Thêm Phương Thức Thanh Toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addPaymentMethodForm" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Phương Thức Thanh Toán</label>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="Nhập Tên Phương Thức Thanh Toán" required>
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
    <div class="modal fade" id="editPaymentMethodModal" tabindex="-1" aria-labelledby="editPaymentMethodModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPaymentMethodModalLabel">Cập Nhật Phương Thức Thanh Toán</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editPaymentMethodForm" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editPaymentMethodId" name="id">
                        <div class="mb-3">
                            <label for="editPaymentMethodName" class="form-label">Tên Phương Thức Thanh Toán</label>
                            <input type="text" class="form-control" id="editPaymentMethodName" name="name"
                                   placeholder="Nhập Tên Phương Thức Thanh Toán" required>
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

    <!-- Delete Payment Method Modal -->
    <div class="modal fade" id="deletePaymentMethodModal" tabindex="-1" aria-labelledby="deletePaymentMethodModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePaymentMethodModalLabel">Xác Nhận Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa phương thức thanh toán này không?
                </div>
                <div class="modal-footer">
                    <form id="deletePaymentMethodForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="deletePaymentMethodId" name="id">
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

            document.getElementById('addPaymentMethodForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {
                    name: document.getElementById('name').value,
                }
                sendAjaxRequest('{{ route('payment_methods.store') }}', 'POST', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi thêm phương thức thanh toán: ', error.message)
                        setFlashMessage('Thêm phương thức thanh toán thất bại!', 'error')
                    })
            })

            var editPaymentMethodModal = document.getElementById('editPaymentMethodModal')
            editPaymentMethodModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var name = button.getAttribute('data-name')
                var form = document.getElementById('editPaymentMethodForm')

                var modalTitle = editPaymentMethodModal.querySelector('.modal-title')
                var modalBodyInputId = editPaymentMethodModal.querySelector('#editPaymentMethodId')
                var modalBodyInputName = editPaymentMethodModal.querySelector('#editPaymentMethodName')

                modalTitle.textContent = 'Cập Nhật Phương Thức Thanh Toán: ' + name
                modalBodyInputId.value = id
                modalBodyInputName.value = name
                form.action = "{{ route('payment_methods.update', '') }}/" + id
            })

            document.getElementById('editPaymentMethodForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = {
                    id: document.getElementById('editPaymentMethodId').value,
                    name: document.getElementById('editPaymentMethodName').value,
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
                        console.error('Lỗi khi cập nhật phương thức thanh toán: ', error.message)
                        setFlashMessage('Cập nhật phương thức thanh toán thất bại!', 'error')
                    })
            })

            var deletePaymentMethodModal = document.getElementById('deletePaymentMethodModal')
            deletePaymentMethodModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var form = document.getElementById('deletePaymentMethodForm')

                var modalBodyInputId = deletePaymentMethodModal.querySelector('#deletePaymentMethodId')
                modalBodyInputId.value = id
                form.action = "{{ route('payment_methods.destroy', '') }}/" + id
            })

            document.getElementById('deletePaymentMethodForm').addEventListener('submit', function (event) {
                event.preventDefault()
                const formData = { id: document.getElementById('deletePaymentMethodId').value }
                sendAjaxRequest(this.action, 'DELETE', formData)
                    .then(data => {
                        if (data.success) {
                            setFlashMessage(data.success, 'success')
                        } else {
                            setFlashMessage(data.error, 'error')
                        }
                    })
                    .catch(error => {
                        console.error('Lỗi khi xóa phương thức thanh toán: ', error.message)
                        setFlashMessage('Xóa phương thức thanh toán thất bại!', 'error')
                    })
            })
        })
    </script>
@endsection
