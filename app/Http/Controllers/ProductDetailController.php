<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Models\ImageProduct;
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
            'quantity' => 'required|integer'
        ]);

        // Kiểm tra trùng lặp
        $exists = ProductDetail::where('product_id', $request->product_id)
            ->where('size_id', $request->size_id)
            ->where('color_id', $request->color_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'Sản phẩm chi tiết với kích thước và màu sắc này đã tồn tại!']);
        }

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

    public function showCustomer($id)
    {
        $products = Product::findOrFail($id);
        $sizes = Size::all();
        $colors = Color::all();
        // Lấy các chi tiết sản phẩm kèm theo thông tin về size và color
        $product_details = ProductDetail::with('size', 'color')
            ->where('product_id', $id)
            ->get();

        // Lấy các hình ảnh sản phẩm dựa trên các chi tiết sản phẩm
        $imageProducts = ImageProduct::whereIn('product_detail_id', $product_details->pluck('id')->toArray())
            ->get();

        return view('customer.product-detail', compact('products', 'sizes', 'colors', 'product_details', 'imageProducts'));
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
            'quantity' => 'required|integer'
        ]);

        $product_details = ProductDetail::findOrFail($product_detail);

        // Kiểm tra trùng lặp, bỏ qua bản ghi hiện tại
        $exists = ProductDetail::where('product_id', $product_details->product_id)
            ->where('size_id', $request->size_id)
            ->where('color_id', $request->color_id)
            ->where('id', '!=', $product_details->id)
            ->exists();

        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'Sản phẩm chi tiết với kích thước và màu sắc này đã tồn tại!']);
        }

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
