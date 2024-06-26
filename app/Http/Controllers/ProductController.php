<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Product::query();
    $categories = Category::all();
    $brands = Brand::all();

    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
              ->orWhere('code', 'like', '%' . $search . '%');
        });
    }

    $query->orderBy('id', 'desc');
    $products = $query->paginate(5);

    return view('admin.product.index')->with(compact('products', 'categories', 'brands'));
}


    public function indexCustomer()
    {

        $products = Product::all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('customer.product')->with(compact('products', 'categories', 'brands', 'colors', 'sizes'));
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
            'name' => 'required|string',
            'image' => 'required|file|image',
            'price' => 'required|integer',
            'introduce' => 'nullable|string',
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
            'name' => 'required|string',
            'image' => 'sometimes|file|image',
            'price' => 'required|integer',
            'introduce' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        $products = Product::findOrFail($product);
        $data = $request->only(['name', 'price', 'introduce', 'category_id', 'brand_id']);

        if ($request->hasFile('image')) {
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
        $products->delete();

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}
