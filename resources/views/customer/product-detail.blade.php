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
                        @php
                            $first = true; // Variable to track the first item for the "active" class
                        @endphp
                        @foreach ($imageProducts as $imageProduct)
                            <div class="carousel-item {{ $first ? 'active' : '' }}">
                                <img class="w-100 h-100" src="{{ asset('storage/' . $imageProduct->url) }}"
                                    alt="Product Image">
                            </div>
                            @php
                                $first = false; // Set to false after the first iteration
                            @endphp
                        @endforeach
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
                <h4 class="font-weight-semi-bold mb-4">{{ number_format($products->price) }} đ</h4>
                <div class="d-flex mb-3">
                    <p class="text-dark font-weight-medium mb-0">Kích thước:</p>
                    <div class="product-size">
                        <form>
                            @php
                                $availableSizes = $product_details->pluck('size.size_name')->unique();
                            @endphp
                            @foreach ($availableSizes as $size)
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" name="size" class="size-button m-1"
                                        data-size="{{ $size }}">
                                    <label class="custom-control-label" for="size-1">{{ $size }}</label>
                                </div>
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
                                    <input type="radio" name="color" class="color-button m-1"
                                        data-color="{{ $color }}"
                                        data-color-id="{{ $product_details->firstWhere('color.name', $color)->color->id }}">
                                    <label class="custom-control-label">{{ $color }}</label>
                                </div>
                            @endforeach
                        </form>
                    </div>
                </div>

                <!-- Phần tử ẩn để lưu trữ sản phẩm chi tiết cho JavaScript sử dụng -->
                <div id="product-details" style="display: none;">
                    @foreach ($product_details as $product_detail)
                        <div class="product-detail-item" data-product-detail-id="{{ $product_detail->id }}"
                            data-size="{{ $product_detail->size->size_name }}"
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
                            <input type="hidden" name="selected_size" id="selected_size">
                            <input type="hidden" name="selected_color" id="selected_color">
                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04"
                                type="submit" id="add-to-cart-button">
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>
                </div>
                <div class="">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Mô tả sản phẩm</p><br>
                    <p class="product-description-text">{{ $products->name }} -
                        {{ $products->code }} {{ $products->introduce }}</p>
                </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedSize = null;
            let selectedColor = null;

            const sizeButtons = document.querySelectorAll('.size-button');
            const colorButtons = document.querySelectorAll('.color-button');
            const carouselInner = document.querySelector('.carousel-inner'); // Carousel container

            const imageProducts = {!! $imageProducts->toJson() !!}; // Convert $imageProducts from PHP to JavaScript object

            function updateProductDetails() {
                console.log('Selected Color:', selectedColor);

                if (selectedColor) {
                    const colorId = selectedColor.getAttribute('data-color-id');
                    const matchingImages = imageProducts.filter(image => {
                        const productDetail = {!! json_encode($product_details) !!}.find(detail => detail.id === image.product_detail_id);
                        return productDetail && productDetail.color.id == colorId;
                    });

                    console.log('Matching Images:', matchingImages);

                    carouselInner.innerHTML = '';

                    matchingImages.forEach((image, index) => {
                        const div = document.createElement('div');
                        div.classList.add('carousel-item');
                        if (index === 0) {
                            div.classList.add('active');
                        }

                        const img = document.createElement('img');
                        img.classList.add('w-100', 'h-100');
                        img.src = `{{ asset('storage/') }}/${image.url}`;
                        img.alt = 'Product Image';

                        div.appendChild(img);
                        carouselInner.appendChild(div);
                    });
                } else {
                    carouselInner.innerHTML = '';
                }
            }

            sizeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    sizeButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                    selectedSize = button.getAttribute('data-size');
                    document.getElementById('selected_size').value = selectedSize;
                });
            });

            colorButtons.forEach(button => {
                button.addEventListener('click', () => {
                    colorButtons.forEach(btn => btn.classList.remove('selected'));
                    button.classList.add('selected');
                    selectedColor = button;
                    document.getElementById('selected_color').value = selectedColor.getAttribute('data-color-id');
                    updateProductDetails();
                });
            });

            const cartForm = document.getElementById('cart-form');
            const numProductInput = document.getElementById('num_product');
            const numProductField = document.querySelector('.num-product');

            cartForm.addEventListener('submit', function(event) {
                event.preventDefault();
                if (!selectedSize || !selectedColor) {
                    alert('Vui lòng chọn size và màu sắc trước khi thêm vào giỏ hàng.');
                    return;
                }
                document.getElementById('selected_size').value = selectedSize;
                document.getElementById('selected_color').value = selectedColor.getAttribute('data-color-id');
                numProductInput.value = numProductField.value;

                cartForm.submit();
            });



            document.querySelectorAll('.num-product').forEach(input => {
                input.addEventListener('input', () => {
                    numProductInput.value = input.value;
                });
            });
        })
    </script>
@endsection
<style>
    .size-button.active,
    .color-button.active {
        border: 2px solid #333;
    }

    .color-button.disabled {
        background-color: #e0e0e0;
        color: #a0a0a0;
        pointer-events: none;
    }

    .custom-control-inline {
        display: inline-flex;
        margin-right: 1rem;
    }

    .custom-radio {
        border-radius: 50%;
    }

    .custom-control-input {
        position: absolute;
        left: 0;
        z-index: -1;
        width: 1rem;
        height: 1.25rem;
        opacity: 0;
    }

    .custom-control-label {
        position: relative;
        margin-bottom: 0;
        vertical-align: top;
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
