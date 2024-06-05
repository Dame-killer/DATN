@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Màu sắc</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addColorModal">
                            Add
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
                                            Trạng thái</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($colors as $color)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $color->name }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">Sử dụng</span>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('colors.destroy', $color->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <input class="btn btn-danger btn-sm" type="submit" value="Delete" />
                                            </form>
                                            <button class="text-secondary font-weight-bold text-xs me-2"
                                                data-bs-toggle="modal" data-bs-target="#editColorModal" data-id="1"
                                                data-name="Đỏ" data-status="Sử dụng">
                                                Edit
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

    <!-- Add Color Modal -->
    <div class="modal fade" id="addColorModal" tabindex="-1" aria-labelledby="addColorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addColorModalLabel">Thêm màu mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('colors.store') }}" method="POST" autocomplete="off">
                        @csrf
{{--                        <div class="mb-3">--}}
{{--                            <label for="colorName" class="form-label">STT</label>--}}
{{--                            <input type="text" class="form-control" id="colorName" name="name" required>--}}
{{--                        </div>--}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên</label>
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên màu" required>
                        </div>
{{--                        <div class="mb-3">--}}
{{--                            <label for="colorStatus" class="form-label">Trạng thái</label>--}}
{{--                            <select class="form-control" id="colorStatus" name="status" required>--}}
{{--                                <option value="Sử dụng">Sử dụng</option>--}}
{{--                                <option value="Không sử dụng">Không sử dụng</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
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
                    <h5 class="modal-title" id="editColorModalLabel">Chỉnh sửa màu</h5>
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
                            <label for="editColorStatus" class="form-label">Trạng thái</label>
                            <select class="form-control" id="editColorStatus" name="status" required>
                                <option value="Sử dụng">Sử dụng</option>
                                <option value="Không sử dụng">Không sử dụng</option>
                            </select>
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
        var editColorModal = document.getElementById('editColorModal')
        editColorModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var name = button.getAttribute('data-name')
            var status = button.getAttribute('data-status')

            var modalTitle = editColorModal.querySelector('.modal-title')
            var modalBodyInputId = editColorModal.querySelector('#editColorId')
            var modalBodyInputName = editColorModal.querySelector('#editColorName')
            var modalBodySelectStatus = editColorModal.querySelector('#editColorStatus')

            modalTitle.textContent = 'Chỉnh sửa màu: ' + name
            modalBodyInputId.value = id
            modalBodyInputName.value = name
            modalBodySelectStatus.value = status
        })
    </script>
@endsection
