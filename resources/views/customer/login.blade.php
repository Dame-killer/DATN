@extends('customer.index')

@section('content')
    <div class="login-wrapper" style="background-image: url('{{ asset('assets/images/layoutDK2.jpg') }}');">
        <div class="login">
            <div class="card mb-6 mx-6">
                <div class="card-body p-6">
                    <div class="d-flex justify-content-center align-items-center m-2">
                        <h3>Đăng nhập</h3>
                    </div> <!-- Thêm lớp này để giới hạn chiều rộng của form -->
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
                        <a href="{{ route('customer-register') }}">
                            <p class="text-dark">Chưa có tài khoản</p>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<style>
    .login-wrapper {
        background-size: cover;
        background-position: center;
        height: 100vh;
        /* Chiều cao toàn màn hình */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login .card {
        background-color: rgba(255, 255, 255, 0.5);
        /* Nền trắng trong suốt */
        border: none;
        /* box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); */
        /* width: 100%; */
        height: 50vh;
        max-width: 700px;
        /* Chiều rộng tối đa của form */
    }

    .login .card-body {
        padding: 2rem;
    }

    .login h3 {
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    /* Điều chỉnh kích thước của form đăng nhập */
    .form-container {
        max-width: 500px;
        margin: 0 auto;
    }
</style>
