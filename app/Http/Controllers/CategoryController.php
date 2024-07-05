<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Category::with('children')->whereNull('parent_id');
        $query->orderBy('id', 'desc');
        $categories = $query->paginate(5);

        return view('admin.category.index', compact('categories'));
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
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        // Kiểm tra trùng lặp tên
        $exists = Category::where('name', $request->name)
            ->where(function ($query) use ($request) {
                if ($request->parent_id) {
                    $query->where('parent_id', $request->parent_id);
                } else {
                    $query->whereNull('parent_id');
                }
            })
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Danh mục đã tồn tại!'], 409);
        }

        if ($request->parent_id) {
            $parent = Category::findOrFail($request->parent_id);
            $parent->children()->create($request->all());
        } else {
            Category::create($request->all());
        }

        return response()->json(['success' => 'Danh mục đã được thêm thành công!'], 200);
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
    public function update(Request $request, $category)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        $categories = Category::findOrFail($category);

        $existing = Category::where('name', $request->name)->where('id', '!=', $category)->first();

        if ($existing) {
            return response()->json(['error' => 'Danh mục đã tồn tại!'], 409);
        }

        $categories->update($request->all());

        return response()->json(['success' => 'Danh mục đã được cập nhật thành công!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $categories = Category::findOrFail($category);
        $categories->children()->delete();
        $categories->delete();

        return response()->json(['success' => 'Danh mục đã được xóa thành công!'], 200);
    }
}
