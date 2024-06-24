@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Thương hiệu</h6>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addBrandModal">
                                Thêm
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <form class="d-flex align-items-center search-bar" method="GET"
                                    action="{{ route('brands.index') }}">
                                    <input class="form-control form-control-sm me-2 custom-input" type="search"
                                        name="search" placeholder="Tìm kiếm" aria-label="Tìm kiếm"
                                        value="{{ request('search') }}">
                                    <button class="btn btn-outline-success btn-sm custom-button" type="submit">Tìm
                                        kiếm</button>
                                </form>
                            </div>
                        </div>

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
                                            Tên thương hiệu
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">
                                                            {{ ($brands->currentPage() - 1) * $brands->perPage() + $loop->iteration }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $brand->name }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <button class="btn btn-warning btn-sm mb-2" data-bs-toggle="modal"
                                                    data-bs-target="#editBrandModal" data-id="{{ $brand->id }}"
                                                    data-name="{{ $brand->name }}">
                                                    Cập nhật
                                                </button>
                                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {{ $brands->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Brand Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Thêm thương hiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brands.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập tên thương hiệu" required>
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

    <!-- Edit Brand Modal -->
    <div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrandModalLabel">Cập nhật thương hiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brands.update', '') }}" method="POST" autocomplete="off" id="editBrandForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editBrandId" name="id">
                        <div class="mb-3">
                            <label for="editBrandName" class="form-label">Tên</label>
                            <input type="text" class="form-control" id="editBrandName" name="name" required>
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
        var editBrandModal = document.getElementById('editBrandModal')
        editBrandModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var name = button.getAttribute('data-name')
            var form = document.getElementById('editBrandForm')

            var modalTitle = editBrandModal.querySelector('.modal-title')
            var modalBodyInputId = editBrandModal.querySelector('#editBrandId')
            var modalBodyInputName = editBrandModal.querySelector('#editBrandName')

            modalTitle.textContent = 'Cập nhật thương hiệu: ' + name
            modalBodyInputId.value = id
            modalBodyInputName.value = name
            form.action = "{{ route('brands.update', '') }}/" + id
        })
    </script>
@endsection
<style>
    .search-bar .form-control-sm {
        height: calc(1.5em + .5rem + 2px);
        /* Adjust the height as needed */
    }

    .search-bar .btn-sm {
        white-space: nowrap;
        /* Prevent text from wrapping */
    }
</style>
