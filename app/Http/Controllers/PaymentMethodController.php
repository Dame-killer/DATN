<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_methods = PaymentMethod::all();

        return view ('admin.pay.index')->with(compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $existing = PaymentMethod::where('name', $request->name)->first();

        if ($existing) {
            return response()->json(['error' => 'Phương thức thanh toán đã tồn tại!'], 409);
        }

        PaymentMethod::create($request->all());

        return response()->json(['success' => 'Phương thức thanh toán đã được thêm thành công!'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $payment_method)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $payment_methods = PaymentMethod::findOrFail($payment_method);

        $existing = PaymentMethod::where('name', $request->name)->where('id', '!=', $payment_method)->first();

        if ($existing) {
            return response()->json(['error' => 'Phương thức thanh toán đã tồn tại!'], 409);
        }

        $payment_methods->update($request->all());

        return response()->json(['success' => 'Phương thức thanh toán đã được cập nhật thành công!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($payment_method)
    {
        $payment_methods = PaymentMethod::findOrFail($payment_method);
        $payment_methods->delete();

        return response()->json(['success' => 'Phương thức thanh toán đã được xóa thành công!'], 200);
    }
}
