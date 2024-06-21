@extends('customer.index')

@section('content')
    <section class="bg-light p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row justify-content-center">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3"><span class="input-group-text">
                            <svg class="icon">
                                <use xlink:href="{{ asset('icons/coreui.svg#cil-envelope-open') }}">
                                </use>
                            </svg></span>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                            placeholder="{{ __('Email') }}" required autofocus>
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
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                            placeholder="Mật khẩu" required>
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
            </div>
        </div>
    </section>
@endsection
