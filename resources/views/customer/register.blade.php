@extends('customer.index')

@section('content')
    <div class="register-wrapper" style="background-image: url('{{ asset('assets/images/layoutDK2.jpg') }}');">
        <div class="register">
            <div class="card mb-4 mx-4">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-center align-items-center m-2">
                        <h3>Đăng ký</h3>
                    </div>

                    <form method="POST" action="/customer/register">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control" type="text" name="name" placeholder="Tên" required
                                autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control" type="text" name="email" placeholder="Email" required
                                autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" placeholder="Mật khẩu" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                                name="password_confirmation" placeholder="Nhập lại mật khẩu" required
                                autocomplete="new-password">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                                </svg>
                            </span>
                            <input class="form-control" type="text" name="phone" placeholder="Số điện thoại" required
                                autocomplete="phone" autofocus>
                            @error('phone')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <button class="btn btn-block btn-success" type="submit">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .register-wrapper {
        background-size: cover;
        background-position: center;
        height: 100vh;
        /* Chiều cao toàn màn hình */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register .card {
        background-color: rgba(255, 255, 255, 0.5);
        /* Nền trắng trong suốt */
        border: none;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        width: 100%;
        max-width: 500px;
        /* Chiều rộng tối đa của form */
    }

    .register .card-body {
        padding: 2rem;
    }

    .register h3 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .input-group-text {
        background-color: #007bff;
        color: #fff;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        color: #fff;
        font-size: 1.2rem;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
</style>
