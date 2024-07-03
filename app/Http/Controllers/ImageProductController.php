<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = ImageProduct::with('productDetail.product', 'productDetail.color');
        $productDetails = ProductDetail::with('product', 'color')->get();
        $products = Product::all();
        $colors = Color::all();
        $query->orderBy('id', 'desc');
        $imageProducts = $query->paginate(5);

        return view('admin.image-product.index', compact('imageProducts', 'productDetails', 'products', 'colors'));
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
            'product_detail_id' => 'required|exists:product_details,id',
            'url' => 'required|file|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('url')) {
            $filePath = $request->file('url')->store('images', 'public');
            $data['url'] = $filePath;
        }

        $existing = ImageProduct::where('product_detail_id', $request->product_detail_id)
            ->where('url', $filePath)
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors(['error' => 'Hình ảnh sản phẩm đã tồn tại!']);
        }

        ImageProduct::create($data);

        return redirect()->back()->with('success', 'Hình ảnh sản phẩm đã được thêm thành công!');
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
    public function update(Request $request, $imageProduct)
    {
        $request->validate([
            'product_detail_id' => 'required|exists:product_details,id',
            'url' => 'sometimes|file|image',
        ]);

        $imageProducts = ImageProduct::findOrFail($imageProduct);
        $data = $request->only(['product_detail_id']);

        $existing = ImageProduct::where('product_detail_id', $request->product_detail_id)
            ->where('url', $request->url)
            ->where('id', '!=', $imageProduct)
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors(['error' => 'Hình ảnh sản phẩm đã tồn tại!']);
        }

        if ($request->hasFile('url')) {
            $filePath = $request->file('url')->store('images', 'public');
            $imageProducts->url = $filePath;
        }

        $imageProducts->update($data);

        return redirect()->back()->with('success', 'Hình ảnh sản phẩm đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imageProduct = ImageProduct::findOrFail($id);
        $imageProduct->delete();

        return redirect()->back()->with('success', 'Hình ảnh sản phẩm đã được xóa thành công!');
    }
}
