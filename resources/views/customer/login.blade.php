@extends('customer.index')

@section('content')
    <div class="bg-white">
    </div>
    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4 mb-3">
                Đăng nhập
            </span>
        </div>
    </div>
    <!-- Dải màu đen với tiêu đề ở trên cùng -->
    <div class="bg-dark text-white py-2 text-center">
        <h1 class="mb-0">Trang Đăng Nhập</h1>
    </div>

    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6"> <!-- Thêm lớp này để giới hạn chiều rộng của form -->
                    <form action="/customer/login" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                                placeholder="{{ __('Email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" placeholder="Mật khẩu" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="d-grid">
                                <button class="btn btn-dark btn-lg" type="submit">Đăng nhập</button>
                            </div>
                        </div>
                        <a href="{{ route('customer-register') }}">Chưa có tài khoản</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
<style>
    /* Điều chỉnh kích thước của form đăng nhập */
    .form-container {
        max-width: 500px;
        margin: 0 auto;
    }
</style>
