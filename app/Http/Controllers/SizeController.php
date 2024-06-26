<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $sizes = Size::all();

        $query = Size::query();

        $sizes = $query->paginate(5);

        return view ('admin.size.index')->with(compact('sizes'));
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
            'size_name' => 'required',
            'size_number' => 'required',
        ]);

        Size::create($request->all());

        return redirect()->back()->with('success', 'Kích cỡ đã được thêm thành công!');
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
    public function update(Request $request, $size)
    {
        $request->validate([
            'size_name' => 'required',
            'size_number' => 'required',
        ]);

        $sizes = Size::findOrFail($size);
        $sizes->update($request->all());

        return redirect()->back()->with('success', 'Kích cỡ đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($size)
    {
        $sizes = Size::findOrFail($size);
        $sizes->delete();

        return redirect()->back()->with('success', 'Kích cỡ đã được xóa thành công!');
    }
}
