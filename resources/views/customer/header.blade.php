<!-- Header -->
<header>
    <!-- Header desktop -->
    {{-- <div class="container-menu-desktop"> --}}
    <div class="wrap-menu-desktop" style="background-color: #F0F8FF">
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

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-cart">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
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

    header .separator {
        border-bottom: 1px solid #D3D3D3;
        margin: 10px 0;
    }

    header button {
        background-color: #FFD700;
        color: #FFFFFF;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
    }

    .header-icons {
        display: flex;
        align-items: center;
    }

    .icon-header-item {
        display: flex;
        align-items: center;
        padding: 0 11px;
        /* Điều chỉnh padding nếu cần */
    }

    .header-input {
        width: 100%;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
    }


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
