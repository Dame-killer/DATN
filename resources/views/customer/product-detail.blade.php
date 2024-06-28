@extends('customer.index')
@section('content')
    <div class="custom-header text-center">
    </div>
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{ route('customer-home') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{ route('customer-product') }}" class="stext-109 cl8 hov-cl1 trans-04">
                Danh mục sản phẩm
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                {{ $products->name }}
            </span>
        </div>
    </div>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            {{-- <div class="wrap-slick3-dots"> --}}
                            <div class="product-view">
                                <div class="large-image-container">
                                    <!-- Ảnh phóng to hiển thị ở đây -->
                                    <img id="largeImage" src="{{ asset('storage/' . $imageProducts->first()->url) }}"
                                        alt="Large Product Image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30 product-detail-container">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $products->name }}
                        </h4>
                        <div class="product-detail">
                            Size:
                            <div class="product-size">
                                @php
                                    $availableSizes = $product_details->pluck('size.size_name')->unique();
                                @endphp
                                @foreach ($availableSizes as $size)
                                    <button class="btn btn-primary size-button" data-size="{{ $size }}">
                                        {{ $size }}
                                    </button>
                                @endforeach
                            </div>

                            Màu sắc:
                            <div class="product-color">
                                @php
                                    $availableColors = $product_details->pluck('color.name')->unique();
                                @endphp
                                @foreach ($availableColors as $color)
                                    <button class="btn color-button" data-color="{{ $color }}">
                                        {{ $color }}
                                    </button>
                                @endforeach
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

                        <div class="flex-w d-flex p-b-10">
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
                    </div>

                </div>
            </div>

            <div class="bor10 m-t-50 p-t-43 p-b-40">
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
                                    Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit
                                    amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus
                                    interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et
                                    elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu
                                    velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec
                                    iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat,
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
                    numProductInput.value = document.querySelector('.num-product').value;
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

    .size-button,
    .color-button {
        padding: 15px 25px;
        /* Increase padding for larger buttons */
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        /* Increase font size */
    }

    .size-button.active,
    .color-button.active {
        border: 2px solid #333;
    }

    .color-button {
        color: #fff;
        /* Default text color for color buttons */
        width: 60px;
        /* Fixed width for color buttons */
        height: 60px;
        /* Fixed height for color buttons */
        text-align: center;
        line-height: 30px;
        /* Center text vertically */
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
        width: 70%;
        text-align: center;
    }

    .large-image-container img {
        max-width: 100%;
        height: auto;
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
