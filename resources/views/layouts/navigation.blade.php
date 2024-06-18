<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 custom-sidenav"
    id="sidenav-main">
    <div class="sidenav-header" style="display: flex; justify-content: center; align-items: center; position: relative;">
        <a class="nav-link {{ Route::currentRouteName() == 'admin-home' ? 'active' : '' }}"
            href="{{ route('admin-home') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="custom-svg-icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="ms-1 font-weight-bold custom-nav-link-text">Dashboard</span>
        </a>
    </div>


    <hr class="horizontal dark mt-0">
    <div class="w-auto" id="sidenav-collapse-main">
        <li class="navbar-nav">
            <a class="nav-link" href="{{ route('admin-order') }}">
                <img
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAgElEQVR4nO2WsQ3AMAzD9P/T7AdFOwixAxLIlEkIrTiRPTD0/Oa6IFPAIPFFKqBaUa09anHgr8AgcUYqYP1GtSqgWlGtCqhWVKsCqpXv2+/b3artd22QE2CQ+CIVcNhja1XA1oqtVQFbK7ZWBWyt2FoVUK2o1ky1GHZ+c00QyQEeotHsIubs6JEAAAAASUVORK5CYII=">
                <span class="nav-link-text ms-1">Quản lý đơn hàng</span>
            </a>
        </li>
        <li class="navbar-nav">
            <a class="nav-link" href="{{ route('admin-cart') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                <span class="nav-link-text ms-1">Quản lý giỏ hàng</span>
            </a>
        </li>
        <li class="navbar-nav">
            <a class="nav-link" href="{{ route('admin-product') }}">
                <img width="50" height="50" src="https://img.icons8.com/ios/50/clothes.png" alt="clothes" />
                <span class="nav-link-text ms-1">Quản lý sản phẩm</span>
            </a>
        </li>
        <li class="navbar-nav">
            <a class="nav-link" href="{{ route('admin-account-customer') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon-size">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                <span class="nav-link-text ms-1">Quản lý khách hàng</span>
            </a>
        </li>
        <li class="navbar-nav">
            <a class="nav-link" href="{{ route('admin-account-employee') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon-size">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="nav-link-text ms-1">Quản lý nhân viên</span>
            </a>
        </li>
        <li class="navbar-nav" id="navbarNavDarkDropdown">
            <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                </svg>
                <span class="nav-link-text ms-1">Quản lý</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{ route('admin-color') }}">
                        <span class="nav-link-text ms-1">Màu sắc</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-image') }}">
                        <span class="nav-link-text ms-1">Hình ảnh</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-brand') }}">
                        <span class="nav-link-text ms-1">Thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-pay') }}">
                        <span class="nav-link-text ms-1">Phương thức thanh toán</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-size') }}">
                        <span class="nav-link-text ms-1">Kích cỡ</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-category') }}">
                        <span class="nav-link-text ms-1">Danh mục</span>
                    </a>
                </li>
            </ul>
        </li>
    </div>
</aside>
<style>
    /* Hiệu ứng hover và active cho các mục điều hướng */
    .nav-link {
        transition: background-color 0.1s ease;
        /* Thêm hiệu ứng chuyển đổi */
    }

    .nav-link:hover {
        background-color: #36dda8;
        /* Màu nền khi hover, bạn có thể thay đổi theo ý muốn */
    }

    .nav-link.active {
        background-color: #36dda8;
        /* Màu nền khi mục được nhấp vào */
    }

    /* Giảm khoảng cách giữa các dòng trong dropdown menu */
    #navbarNavDarkDropdown .dropdown-menu {
        line-height: 1.2;
        /* Điều chỉnh giá trị này để giảm hoặc tăng khoảng cách giữa các dòng */
        padding-top: 0;
        padding-bottom: 0;
    }

    #navbarNavDarkDropdown .dropdown-menu .nav-link {
        padding-top: 5px;
        padding-bottom: 5px;
        margin: 0;
        /* Xóa margin nếu có */
    }

    /* Đặt kích thước cho hình ảnh và biểu tượng */
    .nav-link img,
    .nav-link svg {
        width: 24px;
        height: 24px;
    }

    /* Đặt kích thước cho chữ */
    .nav-link-text {
        font-size: 16px;
        /* hoặc kích thước mà bạn muốn */
        margin-left: 10px;
        /* Khoảng cách giữa biểu tượng và văn bản */
    }

    /* Sử dụng Flexbox để căn chỉnh các mục điều hướng */
    .nav-link {
        display: flex;
        align-items: center;
    }

    /* Đảm bảo khoảng cách giữa các mục điều hướng */
    .navbar-nav {
        list-style: none;
        padding: 0;
    }

    .navbar-nav li {
        margin-bottom: 10px;
        /* Khoảng cách giữa các mục */
    }

    /* Tăng kích thước cho SVG */
    .custom-svg-icon {
        width: 48px;
        /* Tăng kích thước SVG */
        height: 48px;
    }

    .custom-nav-link-text {
        font-size: 24px;
        /* Tăng kích thước văn bản */
        margin-left: 15px;
        /* Điều chỉnh khoảng cách giữa biểu tượng và văn bản */
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const navLinks = document.querySelectorAll('.nav-link');

        function setActiveLink() {
            const currentUrl = window.location.href;

            navLinks.forEach(link => {
                // So sánh href của mỗi link với URL hiện tại
                if (link.href === currentUrl) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }

        // Gọi hàm khi trang tải
        setActiveLink();

        // Thêm sự kiện click cho mỗi link
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Xóa lớp active từ tất cả các liên kết
                navLinks.forEach(nav => nav.classList.remove('active'));

                // Thêm lớp active vào liên kết được nhấp vào
                this.classList.add('active');
            });
        });
    });
</script>
