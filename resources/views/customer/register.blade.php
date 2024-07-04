@extends('customer.index')

@section('content')
    <div class="register">
        <div class="card mb-4 mx-4">
            <div class="card-body p-4">
                <h1>Đăng ký</h1>

                <form method="POST" action="/customer/register">
                    @csrf

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg></span>
                        <input class="form-control" type="text" name="name" placeholder="Tên" required
                            autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                            </svg></span>
                        <input class="form-control" type="text" name="email" placeholder="Email" required
                            autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                            placeholder="Mật khẩu" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="input-group mb-4"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                            </svg></span>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                            name="password_confirmation" placeholder="Nhập lại mật khẩu" required
                            autocomplete="new-password">
                    </div>

                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                            </svg></span>
                        <input class="form-control" type="text" name="phone" placeholder="Số điện thoại" required
                            autocomplete="phone" autofocus>
                        @error('phone')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <button class="btn btn-block btn-success" type="submit">{{ __('Register') }}</button>

                </form>
            </div>
        </div>
    </div>
@endsection
<style>
    /* Định dạng cho phần nội dung của trang đăng ký */
    .register {
        display: flex;
        justify-content: center;
        /* Căn giữa theo chiều ngang */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        height: 100vh;
        /* Chiều cao là 100% chiều cao của màn hình */
    }

    .card {
        width: 100%;
        /* Chiều rộng của thẻ card */
        max-width: 400px;
        /* Chiều rộng tối đa */
        border: none;
        /* Loại bỏ viền */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Đổ bóng */
    }

    .card-body {
        padding: 2rem;
        /* Khoảng cách lề bên trong */
    }

    h1 {
        font-size: 2.5rem;
        /* Kích thước chữ tiêu đề */
        margin-bottom: 1.5rem;
        /* Khoảng cách dưới tiêu đề */
        text-align: center;
        /* Căn giữa tiêu đề */
    }

    .input-group {
        margin-bottom: 1.5rem;
        /* Khoảng cách giữa các input */
    }

    .input-group-text {
        background-color: #007bff;
        /* Màu nền của icon */
        color: #fff;
        /* Màu chữ của icon */
    }

    .form-control {
        border-color: #ced4da;
        /* Màu viền input */
    }

    .btn-success {
        background-color: #28a745;
        /* Màu nền nút */
        border-color: #28a745;
        /* Màu viền nút */
        color: #fff;
        /* Màu chữ nút */
        font-size: 1.2rem;
        /* Kích thước chữ nút */
        margin-top: 1rem;
        /* Khoảng cách trên nút */
    }

    .btn-success:hover {
        background-color: #218838;
        /* Màu nền hover */
        border-color: #1e7e34;
        /* Màu viền hover */
    }
</style>
