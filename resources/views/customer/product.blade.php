@extends('customer.index')

<div class="custom-header text-center">
</div>

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Trang chủ
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Sản phẩm
        </span>
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
                        <h5 class="m-text15 p-b-10">Thương hiệu</h5>
                        <div class="d-flex flex-wrap">
                            @foreach ($brands as $brand)
                                <div class="form-check m-2">
                                    <input type="checkbox" class="form-check-input" id="brand1">
                                    <label class="form-check-label" for="brand1">{{ $brand->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <h5 class="m-text15 p-t-30 p-b-10">Màu sắc</h5>
                        <div class="d-flex flex-wrap">
                            @foreach ($colors as $color)
                                <div class="form-check m-2">
                                    <input type="checkbox" class="form-check-input" id="color1">
                                    <label class="form-check-label" for="color1">{{ $color->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <h5 class="m-text15 p-t-30 p-b-10">Kích cỡ</h5>
                        <div class="d-flex flex-wrap">
                            @foreach ($sizes as $size)
                                <div class="form-check m-2">
                                    <input type="checkbox" class="form-check-input" id="size1">
                                    <label class="form-check-label"
                                        for="size1">{{ $size->size_name }}-{{ $size->size_number }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button class="btn btn-primary" id="filter-button">Tìm kiếm</button>
                        </div>
                    </div>
                </div>

                <!-- Phần 2: Hiển thị sản phẩm -->
                <div class="col-lg-10 col-md-9 col-sm-8">
                    <div class="flex-w flex-sb-m p-b-52">
                        <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".women">
                                Giá tăng dần
                            </button>

                            <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".men">
                                Giá giảm dần
                            </button>
                        </div>
                    </div>

                    <div class="row isotope-grid">
                        @foreach ($products as $product)
                            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                                <!-- Block2 -->
                                <div class="block2">
                                    <div class="block2-pic hov-img0">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            class="img-fluid" style="width: 100%; height: auto;">
                                    </div>

                                    <div class="block2-txt flex-w flex-t p-t-14">
                                        <div class="block2-txt-child1 flex-col-l ">
                                            <a href="{{ route('customer-product-detail', $product->id) }}"
                                                class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                                {{ $product->name }}
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>


                    <!-- Load more -->
                    <div class="flex-c-m flex-w w-full p-t-45">
                        <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                            Load More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
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
