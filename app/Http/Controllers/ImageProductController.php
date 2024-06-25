<?php

namespace App\Http\Controllers;
use App\Models\ImageProduct;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $imageProducts = ImageProduct::with('productDetail.product', 'productDetail.color')->get();
        $productDetails = ProductDetail::with('product', 'color')->get();

        return view('admin.image-product.index', compact('imageProducts', 'productDetails'));
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
            $imagePath = $request->file('url')->store('images', 'public');
            $data['url'] = $imagePath;
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

        return redirect()->route('image_products.index')->with('success', 'Hình ảnh sản phẩm đã được xóa thành công.');
    }
}
