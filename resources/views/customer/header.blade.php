<!-- Header -->
<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <div class="wrap-menu-desktop" style="background-color: #e0f7fa">
            <nav class="limiter-menu-desktop container">
                <!-- Logo desktop -->
                <a href="{{ route('customer-home') }}" class="logo">
                    <img src="{{ asset('assets/images/logo-header.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ route('customer-home') }}">
                                <h4>Trang chủ</h4>
                            </a>
                        </li>
                        <li class="label1" data-label1="hot">
                            <a href="{{ route('customer-product') }}">
                                <h4>Danh mục sản phẩm</h4>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer-shopping-cart') }}">
                                <h4>Giỏ hàng</h4>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <i class="zmdi zmdi-search js-show-input-search"></i>
                        <div class="input-search-header" style="display: none;">
                            <form action="#" method="get">
                                <input class="form-control" type="text" name="search" placeholder="Tìm kiếm...">
                            </form>
                        </div>
                    </div>
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify="2">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <i class="zmdi zmdi-account"></i>
                                @if (Auth::check())
                                    <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                                @endif
                                <ul class="sub-menu">
                                    @if (Auth::check())
                                        <li><a href="{{ route('customer-account') }}">Tài khoản</a></li>
                                        <li><a href="{{ route('customer-logout') }}">Đăng xuất</a></li>
                                    @else
                                        <li><a href="{{ route('customer-login') }}">Đăng nhập</a></li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
            </nav>
        </div>
    </div>
</header>

<style>
    /* Make the logo image clearer */
    .logo img {
        max-height: 80px;
        /* Adjust the height as needed */
        display: block;
    }

    /* Remove underline from the menu text */
    .main-menu a {
        text-decoration: none;
        font-family: 'Arial', sans-serif;
        /* Change to your preferred font */
        font-size: 16px;
        /* Adjust font size as needed */
    }

    /* Change font style of the menu text */
    .main-menu a h4 {
        font-family: 'Arial', sans-serif;
        /* Change to your preferred font */
        font-weight: 700;
        /* Adjust the font weight as needed */
        color: #333;
        /* Adjust the text color as needed */
    }

    /* Apply a more appealing background color to the header */


    /* Add hover effect to menu items */
    .main-menu li a:hover h4 {
        color: #ff6f61;
        /* Change to your preferred hover color */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchIcon = document.querySelector('.js-show-input-search');
        const inputSearchHeader = document.querySelector('.input-search-header');

        searchIcon.addEventListener('click', function() {
            inputSearchHeader.style.display = 'flex';
        });

        // Hide the input when clicking outside
        document.addEventListener('click', function(event) {
            if (!searchIcon.contains(event.target) && !inputSearchHeader.contains(event.target)) {
                inputSearchHeader.style.display = 'none';
            }
        });
    });
</script>
