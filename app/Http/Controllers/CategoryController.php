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
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view ('admin.category.index')->with(compact('categories'));
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
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->parent_id) {
            $parent = Category::findOrFail($request->parent_id);
            $parent->children()->create($request->all());
        } else {
            Category::create($request->all());
        }

        return redirect()->back()->with('success', 'Danh mục đã được thêm thành công!');
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
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $categories = Category::findOrFail($category);
        $categories->update($request->all());

        return redirect()->back()->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($category)
    {
        $categories = Category::findOrFail($category);
        $category->children()->delete();
        $categories->delete();

        return redirect()->back()->with('success', 'Danh mục đã được xóa thành công!');
    }
}
