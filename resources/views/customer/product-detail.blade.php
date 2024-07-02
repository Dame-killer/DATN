@extends('customer.index')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Sản phẩm chi tiết</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('customer-home') }}">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Sản phẩm chi tiết</p>
            </div>
        </div>
    </div>


    <!-- Product Detail -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <!-- Ảnh phóng to hiển thị ở đây -->
                            <img id="largeImage" class="w-100 h-100"
                                src="{{ asset('storage/' . $imageProducts->first()->url) }}" alt="Large Product Image">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $products->name }} - {{ $products->code }}</h3><br>
                <h4 class="font-weight-semi-bold mb-4">{{ $products->price }} VNĐ</h4>
                <p class="mb-4">{{ $products->introduce }}</p>
                <div class="product-detail">
                    <div class="d-flex mb-3">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                        <div class="product-size">
                            <form>
                                @php
                                    $availableSizes = $product_details->pluck('size.size_name')->unique();
                                @endphp
                                @foreach ($availableSizes as $size)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="size" class="size-button"
                                            data-size="{{ $size }}">
                                        <label class="custom-control-label" for="size-1">{{ $size }}</label>
                                    </div>
                                    {{-- <button class="btn btn-primary size-button" data-size="{{ $size }}">
                                            {{ $size }}
                                        </button> --}}
                                @endforeach
                            </form>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <p class="text-dark font-weight-medium mb-0 mr-3">Màu sắc:</p>
                        <div class="product-color">
                            <form>
                                @php
                                    $availableColors = $product_details->pluck('color.name')->unique();
                                @endphp
                                @foreach ($availableColors as $color)
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" name="color" class="color-button"
                                            data-color="{{ $color }}">
                                        <label class="custom-control-label " for="color-1">{{ $color }}</label>
                                    </div>
                                    {{-- <button class="btn color-button" data-color="{{ $color }}">
                                            {{ $color }}
                                        </button> --}}
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Phần tử ẩn để lưu trữ sản phẩm chi tiết cho JavaScript sử dụng -->
                <div id="product-details" style="display: none;">
                    @foreach ($product_details as $product_detail)
                        <div class="product-detail-item" data-size="{{ $product_detail->size->size_name }}"
                            data-color="{{ $product_detail->color->name }}">
                            <input type="hidden" class="product-detail-id" value="{{ $product_detail->id }}">
                        </div>
                    @endforeach
                </div>

                <div class="flex-w d-flex p-b-12">
                    <div class="size-204 flex-w flex-m respon6-next">
                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                <i class="fs-16 zmdi zmdi-minus"></i>
                            </div>

                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product"
                                value="1">

                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                <i class="fs-16 zmdi zmdi-plus"></i>
                            </div>
                        </div>
                        <form action="" method="POST" id="cart-form">
                            @csrf
                            <input type="hidden" name="num_product" id="num_product" value="1">
                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04"
                                type="submit" id="add-to-cart-button">
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </div>

        <div class="row px-xl-5">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla
                                sit
                                amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus
                                interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus
                                et
                                elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus
                                eu
                                velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec
                                iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet
                                consequat,
                                purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus
                                rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>


    <!-- Related Products -->
    {{-- <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            @include('customer.slide')
        </div>
    </section> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedSize = null;
            let selectedColor = null;

            const sizeButtons = document.querySelectorAll('.size-button');
            const colorButtons = document.querySelectorAll('.color-button');
            const productDetailItems = document.querySelectorAll('.product-detail-item');
            const cartForm = document.getElementById('cart-form');
            const numProductInput = document.getElementById('num_product');
            const numProductField = document.querySelector('.num-product');

            function updateProductDetails() {
                let matchingProductDetail = null;

                if (selectedSize && selectedColor) {
                    productDetailItems.forEach(item => {
                        const itemSize = item.getAttribute('data-size');
                        const itemColor = item.getAttribute('data-color');

                        if (itemSize === selectedSize && itemColor === selectedColor) {
                            matchingProductDetail = item;
                        }
                    });
                }

                if (matchingProductDetail) {
                    const productDetailId = matchingProductDetail.querySelector('.product-detail-id').value;
                    cartForm.action = `/customer/product/${productDetailId}`;
                } else {
                    cartForm.action = ''; // Clear the action if no matching product detail is found
                }
            }

            sizeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    sizeButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                    selectedSize = button.getAttribute('data-size');
                    updateProductDetails();
                });
            });

            colorButtons.forEach(button => {
                button.addEventListener('click', () => {
                    colorButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                    selectedColor = button.getAttribute('data-color');
                    updateProductDetails();
                });
            });

            cartForm.addEventListener('submit', function(event) {
                if (!selectedSize || !selectedColor || !cartForm.action) {
                    event.preventDefault();
                    alert('Vui lòng chọn cả kích thước và màu sắc.');
                } else {
                    // Cập nhật giá trị số lượng vào input ẩn trước khi gửi form
                    numProductInput.value = numProductField.value;
                }
            });
        });
    </script>
@endsection
<style>
    .custom-header {
        background-color: rgba(255, 255, 255, 0.8);
        /* Màu nền trắng với độ trong suốt */
        color: rgb(182, 120, 120);
        /* Màu chữ đen */
        padding-top: 50px;
        padding-bottom: 50px;
        position: relative;
        z-index: 10;
        max-height: 100px;
        /* Đảm bảo header đè lên các phần tử khác */
    }

    ///
    .product-detail {
        margin-bottom: 20px;
    }

    .product-size,
    .product-color {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }


    .size-button.active,
    .color-button.active {
        border: 2px solid #333;
    }

    .color-button.disabled {
        background-color: #e0e0e0;
        color: #a0a0a0;
        pointer-events: none;
    }


    /////////


    .bread-crumb a.stext-109,
    .bread-crumb span.stext-109 {
        font-size: 18px;
        /* Thay đổi giá trị này theo kích thước mong muốn */
    }

    .product-detail-container {
        background-color: #f8f9fa;
        max-height: 50%;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .product-detail {
        margin-bottom: 20px;
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 20px;
    }

    .product-price {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .product-introduce {
        margin-top: 10px;
        font-size: 16px;
        color: #666;
    }

    .product-size-color {
        margin-top: 20px;
    }

    .size-color-label {
        font-size: 16px;
        font-weight: bold;
        color: #555;
    }

    .js-addcart-detail {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .js-addcart-detail:hover {
        background-color: #555;
    }

    /* sản phẩm image */
    .product-view {
        display: flex;
        justify-content: space-between;
    }

    .large-image-container {
        width: 100%;
        height: 80%;
        overflow: hidden;
    }

    .large-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumbnail-container {
        width: 25%;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .thumbnail img {
        width: 100%;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .thumbnail img:hover,
    .thumbnail img.active {
        border-color: #333;
    }

    /* trạng thái chọn size vs color */
    /* .size-button.active,
    .color-button.active {
        border: 2px solid #333;
        background-color: #e62a2a;
    } */

    .hidden {
        display: none;
    }

    .size-button.selected,
    .color-button.selected {
        background-color: #ffcc00;
        /* Màu tô khi được chọn */
        border: 1px solid #000;
        /* Tùy chọn: Thêm viền cho các nút được chọn */
    }
</style>
