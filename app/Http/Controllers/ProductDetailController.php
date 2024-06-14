<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'product_id' => 'required|exists:products,id',
            'size_id' => 'required|exists:sizes,id',
            'color_id' => 'required|exists:colors,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'introduce' => 'nullable|string',
        ]);

        ProductDetail::create($request->all());

        return redirect()->back()->with('success', 'Sản phẩm chi tiết đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $products = Product::findOrFail($id);
        $sizes = Size::all();
        $colors = Color::all();
        $product_details = ProductDetail::with('product', 'size', 'color')->where('product_id', $id)->get();

        return view('admin.product-detail.index', compact('products', 'sizes', 'colors', 'product_details'));
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
    public function update(Request $request, $product_detail)
    {
        $request->validate([
            'size_id' => 'required|exists:sizes,id',
            'color_id' => 'required|exists:colors,id',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'introduce' => 'nullable|string',
        ]);

        $product_details = ProductDetail::findOrFail($product_detail);
        $product_details->update($request->all());

        return redirect()->back()->with('success', 'Sản phẩm chi tiết đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_detail)
    {
        $product_details = ProductDetail::findOrFail($product_detail);
        $product_details->delete();

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
