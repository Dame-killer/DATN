<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{ route('customer-home') }}" class="logo">
                    <img src="{{ asset('assets/images/logo1.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ route('customer-home') }}">Trang chủ</a>
                        </li>

                        <li>
                            <a href="{{ route('customer-product') }}">Sản phẩm</a>
                        </li>
                        <li>
                            <a href="{{ route('customer-cart') }}">Giỏ hàng</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify="2">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <ul class="main-menu">
                            <li class="active-menu">
                                {{-- <a href="index.html">Home</a> --}}
                                <i class="zmdi zmdi-account"></i>
                                <ul class="sub-menu">
                                    <li><a href="index.html">Tài khoản</a></li>
                                    <li><a href="home-02.html">Đăng nhập</a></li>
                                    <li><a href="home-03.html">Đăng xuất</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    {{-- <a href="#"
                        class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                        data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a> --}}
                </div>
            </nav>
        </div>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
