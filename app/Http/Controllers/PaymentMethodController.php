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

        PaymentMethod::create($request->all());

        return redirect()->back()->with('success', 'Phương thức thanh toán đã được thêm thành công!');
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
        $payment_methods->update($request->all());

        return redirect()->back()->with('success', 'Phương thức thanh toán đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($payment_method)
    {
        $payment_methods = PaymentMethod::findOrFail($payment_method);
        $payment_methods->delete();

        return redirect()->back()->with('success', 'Phương thức thanh toán đã được xóa thành công!');
    }
}
