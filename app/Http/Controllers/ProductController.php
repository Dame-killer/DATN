<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.index')->with(compact('products', 'categories', 'brands'));
    }

    public function indexCustomer()
    {
        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();

        return view('customer.product')->with(compact('products', 'categories', 'brands'));
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
            'code' => 'required',
            'name' => 'required',
            'image' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        Product::create($data);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm thành công!');
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
    public function update(Request $request, $product)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'image' => 'sometimes|file|image',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        $products = Product::findOrFail($product);
        $data = $request->only(['code', 'name', 'category_id', 'brand_id']);

        if ($request->hasFile('image')) {
            if ($products->image && Storage::disk('public')->exists($products->image)) {
                Storage::disk('public')->delete($products->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $products->update($data);

        return redirect()->back()->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $products = Product::findOrFail($product);
        if ($products->image && Storage::disk('public')->exists($products->image)) {
            Storage::disk('public')->delete($products->image);
        }
        $products->delete();

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
