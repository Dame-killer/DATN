@extends('customer.index')

@section('content')
    <div class="animsition">

        @include('customer.slider')
        @include('customer.featured')
        @include('customer.banner')
        <!-- Products Start -->
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">Sản phẩm</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-left border-right p-0 pt-4 pb-3 m-2">
                                <a href="{{ route('customer-product-detail', $product->id) }}"
                                    class="stext-104 cl4 hov-cl1 trans-04 p-b-6">
                                    <p class="text-truncate mb-3 product-name">{{ $product->name }}</p>
                                </a>
                                <div class="d-flex">
                                    <p class="product-price text-dark">{{ number_format($product->price) }}đ</p>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                <!-- Load more -->
                <div class="flex-c-m flex-w w-full p-t-45">
                    <a href="{{ route('customer-product') }}"
                        class="custom-link flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                        Xem thêm
                    </a>
                </div>
            </div>
        </div>

        <!-- Back to top -->
        <div class="btn-back-to-top" id="myBtn">
            <span class="symbol-btn-back-to-top">
                <i class="zmdi zmdi-chevron-up"></i>
            </span>
        </div>
    </div>
    <style>
        .custom-link {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            /* Bold */
            font-size: 18px;
            /* Increased font size */
            /* color: #fff; */
            /* Font color */
            /* background-color: #000; */
            /* Background color */
            padding: 10px 20px;
            text-decoration: none;
            /* Padding */
            border-radius: 5px;
            /* Rounded corners */
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
        }
    </style>
@endsection
