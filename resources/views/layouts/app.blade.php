<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>LivelyMuse</title>
    <meta name="theme-color" content="#ffffff">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo_header.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    @vite('resources/sass/app.scss')
    @vite('resources/sass/argon-dashboard.scss')
    @vite('resources/sass/_custom.scss')
</head>

<body>
    <div class="min-height-300 position-absolute w-100" style="background-color: #0000FF"></div>
    <div class="sidebar" id="sidebar" style="width: 450px">
        @include('layouts.navigation')
    </div>
    <div class="wrapper d-flex flex-column">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}"
            id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">
                            Trang chủ
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">
                        Trang chủ
                    </h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-4 d-flex align-items-center">
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        @if (Auth::check())
                            <li class="nav-item dropdown d-flex align-items-center m-2">
                                <a href="javascript:;" class="nav-link text-white font-weight-bold px-0"
                                    id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user me-sm-1"></i>
                                    <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item dropdown pe-2 d-flex align-items-center m-2">
                            <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                                @if ($newOrdersCount > 0)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $newOrdersCount }}
                                        <span class="visually-hidden">Đơn hàng mới</span>
                                    </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">

                                @forelse ($newOrders as $order)
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">Đơn hàng mới được tạo</span>
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        <i class="fa fa-clock me-1"></i>
                                                        {{ $order->order_date }}
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @empty
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="javascript:;">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <span class="font-weight-bold">Không có đơn hàng mới</span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforelse
                            </ul>
                        <li class="nav-item dropdown d-flex align-items-center m-2">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out-alt me-sm-1 " style="color: white"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="body flex-grow-1 px-3">
                @yield('content')
        </div>
        {{-- @include('layouts.footer') --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!--   Core JS Files   -->
    {{-- <script src="../../js/core/bootstrap.min.js"></script> --}}
    {{-- <script src="../../js/core/popper.min.js"></script> --}}
    {{-- <script src="../../js/argon-dashboard.js"></script> --}}
    {{-- <script src="../../js/plugins/perfect-scrollbar.min.js"></script> --}}
    {{-- <script src="../../js/plugins/smooth-scrollbar.min.js"></script> --}}
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    {{-- <script src="../../js/argon-dashboard.js"></script> --}}
    @stack('js');
    {{-- <script src="{{ asset('js/coreui.bundle.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    {{-- <script type="module" src="{{ asset('js/bootstrap.js') }}"></script> --}}
</body>

</html>
