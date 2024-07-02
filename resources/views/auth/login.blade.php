@extends('layouts.guest')

@section('content')
    <!-- Login 8 - Bootstrap Brain Component -->
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0 m-1">
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <img class="img-fluid rounded-start custom-img" loading="lazy"
                                    src="{{ asset('assets/images/login2.jpg') }}" alt="Welcome back you've been missed!">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="text-center mb-4">
                                                        <a href="#!">
                                                            <img src="{{ asset('assets/images/login.jpg') }}"
                                                                alt="BootstrapBrain Logo" width="175" height="57">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="input-group mb-3"><span class="input-group-text">
                                                    <svg class="icon">
                                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}">
                                                        </use>
                                                    </svg></span>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    type="text" name="email" placeholder="{{ __('Email') }}" required
                                                    autofocus>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="input-group mb-4"><span class="input-group-text">
                                                    <svg class="icon">
                                                        <use xlink:href="{{ asset('icons/coreui.svg#cil-lock-locked') }}">
                                                        </use>
                                                    </svg></span>
                                                <input class="form-control @error('password') is-invalid @enderror"
                                                    type="password" name="password" placeholder="Mật khẩu" required>
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
                                        </form>
{{--                                        <div class="row">--}}
{{--                                            <div class="col-12">--}}
{{--                                                <div--}}
{{--                                                    class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">--}}
{{--                                                    <a href="#!" class="link-secondary text-decoration-none">Create new--}}
{{--                                                        account</a>--}}
{{--                                                    <a href="#!" class="link-secondary text-decoration-none">Forgot--}}
{{--                                                        password</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<style>
    .custom-img {
        width: 100%;
        height: auto;
        /* Đảm bảo tỷ lệ khung hình không bị thay đổi */
        object-fit: cover;
        /* Đảm bảo ảnh được cắt gọn vừa với khung */
    }

    @media (min-resolution: 2dppx) {
        .custom-img {
            image-rendering: auto;
        }
    }

    /* Thêm thuộc tính để hình ảnh hiển thị tốt trên các thiết bị có độ phân giải cao */
    .custom-img {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
        image-rendering: high-quality;
    }
</style>
