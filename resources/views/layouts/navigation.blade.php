<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 custom-sidenav"
    id="sidenav-main">
    <div class="sidenav-header" style="display: flex; justify-content: center; align-items: center; position: relative;">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="nav-link {{ Route::currentRouteName() == 'admin-home' ? 'active' : '' }}"
            href="{{ route('admin-home') }}" style="display: flex; align-items: center;">
            {{-- <img src="./img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="ms-1 font-weight-bold">Dashboard</span>
        </a>
    </div>

    <hr class="horizontal dark mt-0">
    <div class="w-auto" id="sidenav-collapse-main">
        <li class="navbar-nav">
            <a class="nav-link" href="{{ route('admin-order') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Quản lý đơn hàng</span>
            </a>
        </li>
        <li class="navbar-nav">
            <a class="nav-link" href="{{ route('admin-product') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Quản lý sản phẩm</span>
            </a>
        </li>
        <li class="navbar-nav">
            <a class="nav-link" href="{{ route('admin-account-customer') }}">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                </div>
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
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="icon-size">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="nav-link-text ms-1">Quản lý nhân viên</span>
            </a>
        </li>

        {{-- <li class="collapse navbar-collapse"> --}}
        {{-- <ul class="navbar-nav" > --}}
        <li class="navbar-nav" id="navbarNavDarkDropdown">
            <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false">
                <div
                    class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Quản lý</span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a class="nav-link" href="{{ route('colors.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Màu sắc</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-image') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Hình ảnh</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-brand') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-pay') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Phương thức thanh toán</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-size') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kích cỡ</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link" href="{{ route('admin-category') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Danh mục</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- </ul> --}}
        {{-- </li> --}}

    </div>
</aside>
<style>
    .custom-sidenav {
        border-radius: 20px;
        /* Đặt góc bo tròn */
        overflow: hidden;
        /* Loại bỏ cả thanh cuộn dọc và ngang */
        /* Đảm bảo chiều rộng và chiều cao không vượt quá kích thước viewport */
        max-height: 100vh;
        width: auto;
    }

    .sidenav {
        height: auto;
        overflow: hidden;
        /* Prevents scrollbar */
        display: flex;
        /* flex-direction: column; */
    }

    .sidenav-header {
        padding: 20px;
        flex-shrink: 0;
        /* Prevents header from shrinking */
    }

    .sidenav .w-auto {
        flex-grow: 1;
        overflow-y: auto;
        /* Allows scrolling within the collapse section */
    }

    .icon-size {
        width: 1.5em;
        height: 1.5em;
        vertical-align: middle;
        color: #343a40;
        /* Changes the icon color */
    }

    .nav-link {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .nav-link:hover {
        background-color: #1d87f0;
        color: #2b3d4f;
    }

    .nav-link.active {
        background-color: #6ba0d4;
        font-weight: bold;
        color: #15283b;
    }

    .nav-link-text {
        margin-left: 10px;
        font-size: 1em;
    }

    .sidenav-header .nav-link {
        font-size: 1.25em;
    }

    .sidenav-header .w-6 {
        width: 1.75em;
        height: 1.75em;
        color: #495057;
    }

    .navbar-nav {
        padding-left: 10px;
    }

    .navbar-nav li {
        margin-bottom: 10px;
    }

    .navbar-nav h6 {
        font-size: 0.85em;
        color: #3e5468;
    }
</style>
