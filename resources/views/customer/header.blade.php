<!-- Header -->
<header>
    <!-- Header desktop -->
    {{-- <div class="container-menu-desktop"> --}}
    <div class="wrap-menu-desktop" style="background-color: #F0F8FF">
        <nav class="limiter-menu-desktop">
            <!-- Logo desktop -->
            <a href="{{ route('customer-home') }}" class="logo">
                <img class="image m-10" src="{{ asset('assets/images/logo-header.png') }}" alt="IMG-LOGO">
            </a>

            <!-- Menu desktop -->
            <div class="menu-desktop">
                <ul class="main-menu">
                    <li class="active-menu">
                        <a href="{{ route('customer-home') }}">
                            <h5>Trang chủ</h5>
                        </a>
                    </li>
                    <li class="label1" data-label1="hot">
                        <a href="{{ route('customer-product') }}">
                            <h5>Danh mục sản phẩm</h5>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('customer-shopping-cart') }}">
                            <h5>Giỏ hàng</h5>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m">
                <div class="header-icons">
                    <div class="header-icons">
                        <div class="input-header-item">
                            <form method="GET" action="{{ route('customer-product') }}" id="search-form">
                                <input type="search" name="search" placeholder="Tìm kiếm..." class="header-input"
                                    style="display: none;" aria-label="Tìm kiếm" value="{{ request('search') }}">
                            </form>
                        </div>
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-toggle-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>
                    </div>


{{--                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart">--}}
{{--                        <i class="zmdi zmdi-shopping-cart"></i>--}}
{{--                    </div>--}}
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 ">
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
                                    <li><a href="{{ route('customer-register') }}">Đăng ký</a></li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>
    {{-- </div> --}}
</header>

<style>
    header {
        /* position: fixed; */
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background-color: #F0F8FF;
        /* Màu nền của header */
        padding: 10px 0;
        /* Điều chỉnh padding theo ý của bạn */
    }

    header a {
        color: #FF4500;
        text-decoration: none;
        /* Xóa gạch chân */
    }

    header a:hover {
        text-decoration: underline;
        /* Thêm gạch chân khi hover */
    }

    header button {
        background-color: #FFD700;
        color: #FFFFFF;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 16px;
    }

    .header-icons {
        display: flex;
        align-items: center;
    }

    .input-header-item {
        position: relative;
        margin-left: 10px;
        /* Khoảng cách giữa các phần tử */
    }

    .header-input {
        width: 200px;
        /* Độ rộng của ô tìm kiếm */
        padding: 10px 15px;
        border: 2px solid #007bff;
        /* Màu sắc viền */
        border-radius: 25px;
        /* Bo tròn các góc */
        outline: none;
        font-size: 12px;
        color: #333;
        /* Màu sắc chữ */
        background-color: #f9f9f9;
        /* Màu nền */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Đổ bóng */
        transition: all 0.3s ease;
        /* Hiệu ứng chuyển động */
    }

    .header-input::placeholder {
        color: #999;
        /* Màu sắc của placeholder */
    }

    .header-input:focus {
        border-color: #0056b3;
        /* Màu viền khi focus */
        background-color: #fff;
        /* Màu nền khi focus */
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        /* Đổ bóng khi focus */
    }

    .icon-header-item {
        cursor: pointer;
        /* Hiển thị con trỏ khi hover */
        transition: color 0.3s ease;
        /* Hiệu ứng chuyển động */
    }

    .icon-header-item:hover {
        color: #007bff;
        /* Màu sắc khi hover */
    }



    /* Make the logo image clearer */
    .logo img {
        max-height: 80px;
        /* Adjust the height as needed */
        display: block;
    }

    .main-menu .sub-menu {
        padding: 0;
        transform: translateX(-50%);
        left: 50%;
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

    .active-menu:hover .sub-menu {
        display: block;
    }

    .sub-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        min-width: 150px;
        /* Độ rộng tối thiểu của dropdown */
    }

    .sub-menu li a {
        color: #333;
        text-decoration: none;
        display: block;
        transition: all 0.3s ease;
    }

    .sub-menu li:last-child {
        border-bottom: none;
    }

    .sub-menu li a:hover {
        background-color: #f2f2f2;
    }
</style>

<script>
    document.querySelector('.js-toggle-search').addEventListener('click', function() {
        const inputField = document.querySelector('.header-input');
        if (inputField.style.display === 'none' || inputField.style.display === '') {
            inputField.style.display = 'block';
            inputField.focus(); // Tự động focus vào thẻ input khi hiển thị
        } else {
            inputField.style.display = 'none';
        }
    });
</script>
