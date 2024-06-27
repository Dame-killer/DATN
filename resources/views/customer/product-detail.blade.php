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
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                @foreach ($imageProducts as $imageProduct)
                                    <div class="item-slick3" data-thumb="{{ asset('storage/' . $imageProduct->url) }}"
                                        data-product-detail-id="{{ $imageProduct->product_detail_id }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('storage/' . $imageProduct->url) }}" alt="Product Image"
                                                class="product-image" style="display: none;">
                                        </div>
                                    </div>
                                @endforeach

                                {{-- <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="images/product-detail-01.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="images/product-detail-02.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="images/product-detail-03.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div> --}}
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
                            <div class="p-t-33 product-size">
                                @foreach ($sizes as $size)
                                    <button class="btn btn-primary size-button" data-size="{{ $size->size_name }}">
                                        {{ $size->size_name }}
                                    </button>
                                @endforeach
                            </div>

                            Màu sắc:
                            <div class="p-t-33 product-color">
                                @foreach ($colors as $color)
                                    <button class="btn color-button" data-color="{{ $color->name }}"
                                        style="background-color: {{ $color->code }};">
                                        {{-- {{ $color->name }} --}}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Hidden element to store product details for JavaScript use -->
                        <div id="product-details" style="display: none;">
                            @foreach ($product_details as $product_detail)
                                <div class="product-detail-item" data-size="{{ $product_detail->size->size_name }}"
                                    data-color="{{ $product_detail->color->name }}">
                                </div>
                            @endforeach
                        </div>



                        <div class="flex-w flex-r-m p-b-10">
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
                                <form action="{{ route('customer-cart-add', $product_detail->id) }}" method="POST">
                                    @csrf
                                    <button
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                        type="submit">
                                        Add to cart
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

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">
                SKU: JAK-01
            </span>

            <span class="stext-107 cl6 p-lr-25">
                Categories: Jacket, Men
            </span>
        </div>
    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            @include('customer.slide')
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedSize = null;
            let selectedColor = null;

            const sizeButtons = document.querySelectorAll('.size-button');
            const colorButtons = document.querySelectorAll('.color-button');
            const productDetails = document.querySelectorAll('.product-detail-item');
            const productImages = document.querySelectorAll('.product-image');

            sizeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedSize = this.getAttribute('data-size');
                    filterProductDetails();
                });
            });

            colorButtons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedColor = this.getAttribute('data-color');
                    filterProductDetails();
                });
            });

            function filterProductDetails() {
                if (selectedSize && selectedColor) {
                    let matchingDetailId = null;

                    productDetails.forEach(detail => {
                        const size = detail.getAttribute('data-size');
                        const color = detail.getAttribute('data-color');
                        if (size === selectedSize && color === selectedColor) {
                            matchingDetailId = detail.getAttribute('data-id');
                        }
                    });

                    if (matchingDetailId) {
                        productImages.forEach(img => {
                            const imgDetailId = img.parentElement.getAttribute('data-product-detail-id');
                            if (imgDetailId === matchingDetailId) {
                                img.style.display = 'block';
                            } else {
                                img.style.display = 'none';
                            }
                        });
                    }
                }
            }
        });

        // sizeButtons.forEach(button => {
        //     button.addEventListener('click', function() {
        //         // Clear active states
        //         sizeButtons.forEach(btn => btn.classList.remove('active'));
        //         colorButtons.forEach(btn => btn.classList.remove('active'));
        //         colorButtons.forEach(btn => btn.classList.add('disabled'));

        //         // Set active state for selected size
        //         this.classList.add('active');

        //         // Get selected size
        //         const selectedSize = this.getAttribute('data-size');

        //         // Filter available colors based on selected size
        //         const availableColors = new Set();
        //         productDetails.forEach(detail => {
        //             if (detail.getAttribute('data-size') === selectedSize) {
        //                 availableColors.add(detail.getAttribute('data-color'));
        //             }
        //         });

        //         // Enable available color buttons
        //         colorButtons.forEach(button => {
        //             if (availableColors.has(button.getAttribute('data-color'))) {
        //                 button.classList.remove('disabled');
        //             }
        //         });
        //     });
        // });

        // colorButtons.forEach(button => {
        //     button.addEventListener('click', function() {
        //         if (!this.classList.contains('disabled')) {
        //             // Clear active states
        //             colorButtons.forEach(btn => btn.classList.remove('active'));
        //             // Set active state for selected color
        //             this.classList.add('active');
        //         }
        //     });
        // });
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
</style>
