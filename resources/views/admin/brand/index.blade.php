@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6>Quản Lý Thương Hiệu</h6>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addBrandModal">
                                Thêm
                            </button>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-4">
                                <form class="d-flex align-items-center search-bar" method="GET"
                                    action="{{ route('brands.index') }}">
                                    <input class="form-control form-control-sm me-2 custom-input" type="search"
                                        name="search" placeholder="Nhập Từ Khóa" aria-label="Tìm kiếm"
                                        value="{{ request('search') }}">
                                    <button class="btn btn-outline-success btn-sm custom-button" type="submit">
                                        Tìm Kiếm
                                    </button>
                                </form>
                            </div>
                        </div> --}}
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
                                            Tên Thương Hiệu
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Thao
                                            tác</th>
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
                                                    Cập Nhật
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm mb-2"
                                                    data-bs-toggle="modal" data-bs-target="#deleteBrandModal"
                                                    data-id="{{ $brand->id }}">
                                                    Xóa
                                                </button>
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
                    <h5 class="modal-title" id="addBrandModalLabel">Thêm Thương Hiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brands.store') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên Thương Hiệu</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Nhập Tên Thương Hiệu" required>
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
                    <h5 class="modal-title" id="editBrandModalLabel">Cập Nhật Thương Hiệu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('brands.update', '') }}" method="POST" autocomplete="off" id="editBrandForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editBrandId" name="id">
                        <div class="mb-3">
                            <label for="editBrandName" class="form-label">Tên Thương Hiệu</label>
                            <input type="text" class="form-control" id="editBrandName" name="name"
                                placeholder="Nhập Tên Thương Hiệu" required>
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

    <!-- Delete Brand Modal -->
    <div class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="deleteBrandModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteBrandModalLabel">Xác Nhận Xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa thương hiệu này không?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('brands.destroy', '') }}" id="deleteBrandForm" method="POST">
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
        var editBrandModal = document.getElementById('editBrandModal')
        editBrandModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var id = button.getAttribute('data-id')
            var name = button.getAttribute('data-name')
            var form = document.getElementById('editBrandForm')

            var modalTitle = editBrandModal.querySelector('.modal-title')
            var modalBodyInputId = editBrandModal.querySelector('#editBrandId')
            var modalBodyInputName = editBrandModal.querySelector('#editBrandName')

            modalTitle.textContent = 'Cập Nhật Thương Hiệu: ' + name
            modalBodyInputId.value = id
            modalBodyInputName.value = name
            form.action = "{{ route('brands.update', '') }}/" + id
        })

        document.addEventListener('DOMContentLoaded', function() {
            var deleteBrandModal = document.getElementById('deleteBrandModal')
            deleteBrandModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget
                var id = button.getAttribute('data-id')
                var form = document.getElementById('deleteBrandForm')
                form.action = "{{ route('brands.destroy', '') }}/" + id
            })
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
