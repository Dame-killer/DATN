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
                            <a href="{{ route('customer-home') }}">
                                <h4>Trang chủ</h4>
                            </a>
                        </li>
                        <li>
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
                                    <li><a href="{{ route('customer-account') }}">Tài khoản</a></li>
                                    <li><a href="{{ route('customer-login') }}">Đăng nhập</a></li>
                                    <li><a href="{{ route('customer-logout') }}">Đăng xuất</a></li>
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
    /* Tăng cỡ chữ */
    .main-menu a {
        font-size: 18px;
    }

    .icon-header-item {
        font-size: 32px;
    }

    /* CSS cho ô input search */
    .input-search-header {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        display: none;
        /* Ẩn ban đầu để khi click mới hiển thị */
        align-items: center;
        padding: 5px 10px;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .input-search-header .form-control {
        width: 200px;
        border: none;
        outline: none;
    }

    .input-search-header .form-control::placeholder {
        color: #aaa;
    }

    /* Điều chỉnh vị trí hiển thị của ô search */
    .icon-header-item {
        position: relative;
        /* Để có thể định vị tương đối cho con bên trong */
    }

    /* Điều chỉnh vị trí hiển thị khi click vào icon search */
    .icon-header-item .input-search-header {
        position: absolute;
        top: 100%;
        left: 0;
        transform: translateY(10px);
        /* Điều chỉnh khoảng cách từ icon xuống input */
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
