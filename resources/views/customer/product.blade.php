@extends('customer.index')

<div class="custom-header text-center">
</div>

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{ route('customer-home') }}" class="stext-109 cl8 hov-cl1 trans-04">
            Trang chủ
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="{{ route('customer-product') }}" class="stext-109 cl4">
            Sản phẩm
        </a>
    </div>
</div>

@section('content')
    <!-- Product -->
    <div class="bg0 m-t-23 p-b-140">
        <div class="container">
            <div class="row">
                <!-- Phần 1: Các ô checkbox để chọn thương hiệu, màu sắc, kích cỡ -->
                <div class="col-lg-2 col-md-3 col-sm-4 p-t-30">
                    <div class="filter-section">
                        <form method="GET" action="{{ route('customer-product') }}">

                            <h5 class="m-text15 p-b-10">Danh mục</h5>
                            <div class="d-flex flex-wrap">
                                @foreach ($categories as $category)
                                    <div class="form-check m-2">
                                        <input type="checkbox" class="form-check-input" id="category{{ $category->id }}"
                                            name="category[]" value="{{ $category->id }}">
                                        <label class="form-check-label"
                                            for="category{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <h5 class="m-text15 p-b-10">Thương hiệu</h5>
                            <div class="d-flex flex-wrap">
                                @foreach ($brands as $brand)
                                    <div class="form-check m-2">
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
                    <div class="flex-w flex-sb-m p-b-52">
                        <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                            <a href="{{ route('customer-product', ['sort' => 'asc']) }}"
                                class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
                                Giá tăng dần
                            </a>

                            <a href="{{ route('customer-product', ['sort' => 'desc']) }}"
                                class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
                                Giá giảm dần
                            </a>
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
                                                {{ $product->price }} đ
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
    </div>
@endsection

<style>
    .block2 {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .block2:hover {
        transform: scale(1.05);
    }

    .block2-pic {
        position: relative;
        overflow: hidden;
    }

    .block2-pic img {
        transition: transform 0.3s ease;
    }

    .block2-pic:hover img {
        transform: scale(1.1);
    }

    .block2-txt {
        padding: 15px;
        text-align: center;
    }

    .stext-104 {
        font-size: 1.1rem;
        font-weight: bold;
    }

    .stext-105 {
        font-size: 1rem;
        color: #888;
    }

    .isotope-grid {
        display: flex;
        flex-wrap: wrap;
    }

    .isotope-item {
        display: flex;
        justify-content: center;
        align-items: stretch;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: bold;
    }

    .card-text {
        font-size: 1rem;
        color: #333;
    }

    .block2 {
        border: 1px solid #e1e1e1;
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }

    .block2:hover {
        transform: translateY(-5px);
    }

    .block2-pic img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease-in-out;
    }

    .block2:hover .block2-pic img {
        transform: scale(1.1);
    }

    .stext-104 {
        color: #555;
        text-decoration: none;
    }

    .stext-104:hover {
        color: #000;
    }

    .stext-105 {
        color: #999;
    }


    //
    .custom-header {
        background-color: rgba(255, 255, 255, 0.8);
        /* Màu nền trắng với độ trong suốt */
        padding-top: 50px;
        padding-bottom: 50px;
        position: relative;
        z-index: 10;
        /* Đảm bảo header đè lên các phần tử khác */
    }

    .bread-crumb a.stext-109,
    .bread-crumb span.stext-109 {
        font-size: 18px;
        /* Thay đổi giá trị này theo kích thước mong muốn */
    }
</style>
