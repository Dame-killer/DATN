<!DOCTYPE html>
<html lang="en">

<head>
    <title>LivelyMuse</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo_header.png') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}"> --}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/linearicons-v1.0.0/icon-font.min.css') }}"> --}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/slick.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/magnific-popup.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/perfect-scrollbar.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
    <!--===============================================================================================-->
    @vite('resources/sass/app.scss')
    {{-- @vite('resources/sass/argon-dashboard.scss') --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link
        href="https://cdn.jsdelivr.net/npm/material-design-iconic-font@2.2.0/dist/css/material-design-iconic-font.min.css"
        rel="stylesheet" />
    <style>
        .product-name {
            font-size: 1.5em;
            /* Increase the size of the product name */
            color: rgba(12, 11, 11, 0.6);
            /* Make the product name slightly faded */
        }

        .product-price {
            font-size: 2em;
            /* Increase the size of the product price */
            font-weight: bold;
            /* Make the price bold */
        }

        .header-cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-cart-item-img {
            flex-shrink: 0;
            margin-right: 10px;
        }

        .header-cart-item-txt {
            flex-grow: 1;
        }

        .header-cart-item-remove {
            flex-shrink: 0;
            margin-left: 10px;
        }
    </style>
</head>

<body class="animsition">
    <div class="index-content">
        @include('customer.header')

        {{-- <!-- Cart -->
        <div class="wrap-header-cart js-panel-cart">
            <div class="s-full js-hide-cart"></div>

            <div class="header-cart flex-col-l p-l-65 p-r-25">
                <div class="header-cart-title flex-w flex-sb-m p-b-8">
                    <span class="mtext-103 cl2">
                        Giỏ hàng
                    </span>

                    <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                        <i class="zmdi zmdi-close"></i>
                    </div>
                </div>

                <div class="header-cart-content flex-w js-pscroll">
                    <ul class="header-cart-wrapitem">
                        @foreach ($order_details as $order_detail)
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="row w-100">
                                    <!-- Image Section -->
                                    <div class="header-cart-item-img col-md-4">
                                        <img src="{{ $order_detail->product_detail->product->image }}"
                                            alt="{{ $order_detail->product_detail->product->name }}" class="img-fluid">
                                    </div>

                                    <!-- Text Section -->
                                    <div class="header-cart-item-txt col-md-5 p-t-8">
                                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                            {{ $order_detail->product_detail->product->name }}
                                        </a>
                                        <span class="header-cart-item-info">
                                            {{ $order_detail->amount }} x
                                            {{ number_format($order_detail->unit_price) }}đ
                                        </span>
                                    </div>

                                    <!-- Remove Button Section -->
                                    <div class="header-cart-item-remove col-md d-flex justify-content-centre">
                                        <form
                                            action="{{ route('customer-cart-remove', $order_detail->product_detail->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">X</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>


                    <div class="w-full">
                        <div class="header-cart-total w-full p-tb-40">
                            Tổng: {{ number_format($totalPrice) }}đ
                        </div>

                        <div class="header-cart-buttons flex-w w-full">
                            <a href="shoping-cart.html"
                                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                                Xem giỏ hàng
                            </a>

                            <a href="shoping-cart.html"
                                class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                                Thanh toán
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        @yield('content')

        @include('customer.footer')


        <!-- Back to top -->
        <div class="btn-back-to-top" id="myBtn">
            <span class="symbol-btn-back-to-top">
                <i class="zmdi zmdi-chevron-up"></i>
            </span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick-custom.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        // $('.js-addcart-detail').each(function() {
        //     var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        //     $(this).on('click', function() {
        //         swal(nameProduct, "is added to cart !", "success");
        //     });
        // });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
