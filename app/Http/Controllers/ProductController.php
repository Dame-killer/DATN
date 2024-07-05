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


public function indexCustomer(Request $request)
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

    if ($request->has('category') && !empty($request->category)) {
        $query->where('category_id', $request->category);
    }

    if ($request->has('brand') && !empty($request->brand)) {
        $query->where('brand_id', $request->brand);
    }

    if ($request->has('sort')) {
        if ($request->sort == 'asc' || $request->sort == 'desc') {
            $query->orderBy('price', $request->sort);
        } elseif ($request->sort == 'newest') {
            $query->orderBy('id', 'desc');
        }
    }

    $products = $query->paginate(8);

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
            'name' => 'required|string',
            'image' => 'required|file|image',
            'price' => 'required|integer',
            'introduce' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
        ]);

        $existing = Product::where('name', $request->name)->first();

        if ($existing) {
            return response()->json(['error' => 'Sản phẩm đã tồn tại!'], 409);
        }

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        Product::create($data);

        return response()->json(['success' => 'Sản phẩm đã được thêm thành công!'], 200);
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

        $existing = Product::where('name', $request->name)->where('id', '!=', $product)->first();
        if ($existing) {
            return response()->json(['error' => 'Sản phẩm đã tồn tại!'], 409);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;
        }

        $products->update($data);

        return response()->json(['success' => 'Sản phẩm đã được thêm thành công!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $products = Product::findOrFail($product);
        $products->delete();

        return response()->json(['success' => 'Sản phẩm đã được xóa thành công!'], 200);
    }
}
