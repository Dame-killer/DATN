@extends('customer.index')



@section('content')
    <div class="custom-header text-center">
    </div>
    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140">
        <!-- breadcrumb -->
        <div class="container">
            <div class="bread-crumb flex-w p-l-25 p-r-15 p-lr-0-lg">
                <a href="{{ route('customer-home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                    Trang chủ
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </a>

                <span class="stext-109 cl4">
                    Cửa hàng
                </span>
            </div>
        </div>
        <div class="breadcrumb-container m-2">
            <img src="{{ asset('assets/images/customer-product-banner.jpg') }}" alt="Customer Product Banner">
        </div>


        <div class="row">
            <!-- Phần 1: Các ô checkbox để chọn thương hiệu, màu sắc, kích cỡ -->
            <div class="col-lg-2 col-md-3 col-sm-4 p-t-30">
                <div class="filter-section">
                    <form method="GET" action="{{ route('customer-product') }}">

                        <h5 class="m-text15 p-b-10">Danh mục</h5>
                        <div class="d-flex flex-column">
                            @foreach ($categories as $category)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="category{{ $category->id }}"
                                        name="category[]" value="{{ $category->id }}">
                                    <label class="form-check-label"
                                        for="category{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <h5 class="m-text15 p-b-10">Thương hiệu</h5>
                        <div class="d-flex flex-column">
                            @foreach ($brands as $brand)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="brand{{ $brand->id }}"
                                        name="brand[]" value="{{ $brand->id }}">
                                    <label class="form-check-label"
                                        for="brand{{ $brand->id }}">{{ $brand->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Phần 2: Hiển thị sản phẩm -->
            <div class="col-lg-10 col-md-9 col-sm-8">
                <!-- Thêm anchor vào đây -->
                <a id="product-list"></a>
                <div class="flex-w justify-content-end p-b-52">
                    <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                        <select id="sort-options" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
                            <option
                                value="{{ route('customer-product', array_merge(request()->query(), ['sort' => ''])) }}"
                                {{ request()->get('sort') == '' ? 'selected' : '' }}>
                                Sắp xếp
                            </option>
                            <option
                                value="{{ route('customer-product', array_merge(request()->query(), ['sort' => 'asc'])) }}"
                                {{ request()->get('sort') == 'asc' ? 'selected' : '' }}>
                                Giá tăng dần
                            </option>
                            <option
                                value="{{ route('customer-product', array_merge(request()->query(), ['sort' => 'desc'])) }}"
                                {{ request()->get('sort') == 'desc' ? 'selected' : '' }}>
                                Giá giảm dần
                            </option>
                            <option
                                value="{{ route('customer-product', array_merge(request()->query(), ['sort' => 'newest'])) }}"
                                {{ request()->get('sort') == 'newest' ? 'selected' : '' }}>
                                Sản phẩm mới nhất
                            </option>
                        </select>
                    </div>
                </div>


                <div class="row isotope-grid">
                    @forelse ($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                            <div class="block2 card h-100 d-flex flex-column">
                                <div class="block2-pic hov-img0">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="img-fluid card-img-top">
                                </div>
                                <div class="block2-txt flex-w flex-t p-t-14 card-body d-flex flex-column">
                                    <div class="block2-txt-child1 flex-col-l mb-auto">
                                        <a href="{{ route('customer-product-detail', $product->id) }}"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 card-title">
                                            {{ $product->name }}
                                        </a>
                                        <span class="stext-105 cl3 card-text">
                                            {{ number_format($product->price) }}đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p class="text-center">Không có sản phẩm nào phù hợp với tiêu chí tìm kiếm của bạn.</p>
                        </div>
                    @endforelse
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    /* filter */
    .custom-header {
        background-color: rgba(255, 255, 255, 0.8);
        /* Màu nền trắng với độ trong suốt */
        padding-top: 80px;
        /* padding-bottom: 80px; */
        position: relative;
        /* Đảm bảo header đè lên các phần tử khác */
    }

    .filter-section {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .filter-section h5 {
        color: #333;
        margin-bottom: 15px;
    }

    .filter-section .form-check {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .filter-section .form-check-input {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }

    .filter-section .form-check-label {
        font-size: 14px;
        color: #555;
    }

    .filter-section .btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .filter-section .btn:hover {
        background-color: #0056b3;
    }

    //

    /* Sắp xếp giá tăng giảm */
    /* Move the select element to the right and increase font size */
    .flex-w.flex-sb-m {
        justify-content: flex-end;
    }

    .filter-tope-group {
        width: auto;
    }

    #sort-options {
        font-size: 18px;
        /* Increase font size */
        padding: 10px 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        color: #333;
        appearance: none;
        /* Remove default arrow */
        -webkit-appearance: none;
        /* Remove default arrow for Safari */
        -moz-appearance: none;
        /* Remove default arrow for Firefox */
        position: relative;
        background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23333" d="M2 0L0 2h4zM2 5L0 3h4z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 10px top 50%;
        background-size: 10px 10px;
        margin-top: 5px;
    }

    /* Additional styling to remove the default arrow on select */
    #sort-options::-ms-expand {
        display: none;
    }

    /* Hiển thị sản phẩm */
    .isotope-grid .block2-pic img {
        width: 350px;
        height: 400px;
        object-fit: cover;
    }

    .card {
        border: none;
        /* Bỏ khung */
    }

    .card-img-top {
        border-radius: 10px;
        /* Bo tròn 4 góc của ảnh sản phẩm */
        overflow: hidden;
        /* Đảm bảo các nội dung không vượt ra ngoài biên */
    }


    .card-text {
        font-size: 2rem;
        /* Tăng cỡ chữ của giá sản phẩm */
        font-weight: bold;
        /* In đậm giá sản phẩm */
    }

    /* image vs header */
    .bread-crumb {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .bread-crumb a,
    .bread-crumb span {
        font-size: 18px;
        /* Adjust the font size as needed */
        color: #555;
        /* Adjust the color if needed */
    }

    .bread-crumb a {
        text-decoration: none;
    }

    .bread-crumb a:hover {
        color: #333;
        /* Change the hover color if needed */
    }

    .bread-crumb i {
        margin: 0 5px;
    }

    .breadcrumb-container img {
        width: 100%;
        display: block;
        margin: 20px 0;
        /* Adjust the margin if needed */
    }

    //
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sortSelect = document.getElementById('sort-options');
        sortSelect.addEventListener('change', function() {
            var selectedOption = sortSelect.value;
            if (selectedOption) {
                window.location.href = selectedOption + '#product-list';
            }
        });
    });
</script>
