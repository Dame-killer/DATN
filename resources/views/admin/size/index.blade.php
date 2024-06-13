@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Kích cỡ</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addSizeModal">
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
                                        Kích cỡ
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($sizes as $size)
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
                                                {{ $size->size_name }}-{{ $size->size_number }}</p>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#editSizeModal" data-id="{{ $size->id }}"
                                                    data-name="{{ $size->size_name }}"
                                                    data-number="{{ $size->size_number }}">
                                                Cập nhật
                                            </button>
                                            <form action="{{ route('sizes.destroy', $size->id) }}" method="POST">
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

    <!-- Add Size Modal -->
    <div class="modal fade" id="addSizeModal" tabindex="-1" aria-labelledby="addSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSizeModalLabel">Thêm kích cỡ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sizes.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="size_name" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="size_name" name="size_name"
                                   placeholder="Nhập tên kích cỡ" required>
                        </div>
                        <div class="mb-3">
                            <label for="size_number" class="form-label">Số</label>
                            <input type="number" class="form-control" id="size_number" name="size_number"
                                   placeholder="Nhập số kích cỡ" required>
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

    <!-- Edit Size Modal -->
    <div class="modal fade" id="editSizeModal" tabindex="-1" aria-labelledby="editSizeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSizeModalLabel">Cập nhật kích cỡ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('sizes.update', '') }}" method="POST" autocomplete="off" id="editSizeForm">
                        @method('PUT')
                        @csrf
                        <input type="hidden" id="editSizeId" name="id">
                        <div class="mb-3">
                            <label for="editSizeName" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="editSizeName" name="size_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editSizeNumber" class="form-label">Số</label>
                            <input type="number" class="form-control" id="editSizeNumber" name="size_number" required>
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
        var editSizeModal = document.getElementById('editSizeModal')
        editSizeModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var size_name = button.getAttribute('data-name')
            var size_number = button.getAttribute('data-number')
            var form = document.getElementById('editSizeForm')

            var modalTitle = editSizeModal.querySelector('.modal-title')
            var modalBodyInputId = editSizeModal.querySelector('#editSizeId')
            var modalBodyInputName = editSizeModal.querySelector('#editSizeName')
            var modalBodyInputNumber = editSizeModal.querySelector('#editSizeNumber')

            modalTitle.textContent = 'Cập nhật kích cỡ: ' + size_name + size_number
            modalBodyInputId.value = id
            modalBodyInputName.value = size_name
            modalBodyInputNumber.value = size_number
            form.action = "{{ route('sizes.update', '') }}/" + id
        })
    </script>
@endsection
