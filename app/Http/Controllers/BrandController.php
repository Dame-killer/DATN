<?php

namespace App\Http\Controllers;

use App\Http\Resources\Brand\BrandCollection;
use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Brand::query();
        $query->orderBy('id', 'desc');
        $brands = $query->paginate(5);

        return view('admin.brand.index', compact('brands'));
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

        $existing = Brand::where('name', $request->name)->first();

        if ($existing) {
            return redirect()->back()->withErrors(['error' => 'Thương hiệu đã tồn tại!']);
        }

        Brand::create($request->all());

        return redirect()->back()->with('success', 'Thương hiệu đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
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
    public function update(Request $request, $brand)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $brands = Brand::findOrFail($brand);

        $existing = Brand::where('name', $request->name)->where('id', '!=', $brand)->first();

        if ($existing) {
            return redirect()->back()->withErrors(['error' => 'Thương hiệu đã tồn tại!']);
        }

        $brands->update($request->all());

        return redirect()->back()->with('success', 'Thương hiệu đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($brand)
    {
        $brands = Brand::findOrFail($brand);
        $brands->delete();

        return redirect()->back()->with('success', 'Thương hiệu đã được xóa thành công!');
    }
}
