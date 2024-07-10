{{-- @extends('customer.index')

@section('content') --}}
<div class="container mt-5">
    <h2>Thanh toán VNPay</h2>
    <form method="POST" action="{{ route('payment.vnpay') }}">
        @csrf
        <button type="submit" name="redirect">Thanh toán VNPay</button>
    </form>
</div>
{{-- @endsection --}}
