@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Tài khoản khách hàng</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addAuthorModal">
                            Thêm
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            STT</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tên</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Email</th>

                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">1</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">Long</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">Long@gmail.com</p>
                                        </td>
                                        <td class="align-middle text-center"><span
                                                class="text-secondary text-xs font-weight-bold">23/04/18</span></td>
                                        <td class="align-middle">
                                            <button href="javascript:;" class="text-secondary font-weight-bold text-xs me-2"
                                                data-bs-toggle="modal" data-bs-target="#editCustomerModal" data-id="1"
                                                data-name="Long" data-status="Sử dụng" data-email="Long@gmail.com">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Author Modal -->
    <div class="modal fade" id="addAuthorModal" tabindex="-1" aria-labelledby="addAuthorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAuthorModalLabel">Thêm mới tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="authorName" class="form-label">STT</label>
                            <input type="text" class="form-control" id="authorId" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorEmail" class="form-label">Tên</label>
                            <input type="email" class="form-control" id="authorName" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="authorFunction" class="form-label">Email</label>
                            <input type="text" class="form-control" id="authorEmail" name="function" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Color Modal -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editCustomerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCustomerModalLabel">Chỉnh sửa tài khoản</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editColorId" name="id">
                        <div class="mb-3">
                            <label for="editColorName" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="editColorName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editColorEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" id="editColorEmail" name="email" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var editCustomerModal = document.getElementById('editCustomerModal')
        editCustomerModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var name = button.getAttribute('data-name')
            var status = button.getAttribute('data-status')
            var email = button.getAttribute('data-email')

            var modalTitle = editCustomerModal.querySelector('.modal-title')
            var modalBodyInputId = editCustomerModal.querySelector('#editColorId')
            var modalBodyInputName = editCustomerModal.querySelector('#editColorName')
            var modalBodySelectStatus = editCustomerModal.querySelector('#editColorStatus')
            var modalBodySelectEmail = editCustomerModal.querySelector('#editColorEmail')

            modalTitle.textContent = 'Chỉnh sửa tài khoản: ' + name
            modalBodyInputId.value = id
            modalBodyInputName.value = name
            modalBodySelectStatus.value = status
            modalBodySelectEmail.value = email
        })
    </script>
@endsection
