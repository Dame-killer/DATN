<?php

namespace App\Http\Controllers;

use App\Http\Resources\Color\ColorCollection;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Color::query();
        $query->orderBy('id', 'desc');
        $colors = $query->paginate(5);

        return view ('admin.color.index')->with(compact('colors'));
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
            'code' => 'required'
        ]);

        Color::create($request->all());

        return response()->json(['success' => 'Màu sắc đã được thêm thành công!'], 200);
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
    public function edit($color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $color)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required'
        ]);

        $colors = Color::findOrFail($color);
        $colors->update($request->all());

        return response()->json(['success' => 'Màu sắc đã được cập nhật thành công!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($color)
    {
        $colors = Color::findOrFail($color);
        $colors->delete();

        return response()->json(['success' => 'Màu sắc đã được xóa thành công!'], 200);
    }
}
