@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Doanh Thu</p>
                                    <h5 class="font-weight-bolder">{{ number_format($totalRevenue) }} VNĐ</h5>
                                    <p class="mb-0">
                                        <span class="text-{{ $revenueChange >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                                            {{ $revenueChange >= 0 ? '+' : '' }}{{ number_format($revenueChange, 2) }}%
                                        </span>
                                        kể từ tháng trước
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Sản Phẩm Đã Bán</p>
                                    <h5 class="font-weight-bolder">{{ $totalSoldProducts }}</h5>
                                    <p class="mb-0">
                                        <span class="text-{{ $soldProductsChange >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                                            {{ $soldProductsChange >= 0 ? '+' : '' }}{{ number_format($soldProductsChange, 2) }}%
                                        </span>
                                        kể từ tháng trước
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Order Hoàn Thành</p>
                                    <h5 class="font-weight-bolder">{{ $completedOrders }}</h5>
                                    <p class="mb-0">
                                        <span class="text-{{ $completedOrdersChange >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                                            {{ $completedOrdersChange >= 0 ? '+' : '' }}{{ number_format($completedOrdersChange, 2) }}%
                                        </span>
                                        kể từ tháng trước
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Order Hủy</p>
                                    <h5 class="font-weight-bolder">{{ $canceledOrders }}</h5>
                                    <p class="mb-0">
                                        <span class="text-{{ $canceledOrdersChange >= 0 ? 'success' : 'danger' }} text-sm font-weight-bolder">
                                            {{ $canceledOrdersChange >= 0 ? '+' : '' }}{{ number_format($canceledOrdersChange, 2) }}%
                                        </span>
                                        kể từ tháng trước
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
