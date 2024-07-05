<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $view = request()->segment(2); // Lấy phần tử thứ 2 của URL
        $users = [];

        switch ($view) {
            case 'acount-customer':
                $users = User::where('role', 0)->get();
                break;
            case 'acount-employee':
                $users = User::whereIn('role', [1, 2])->get();
                break;
            default:
                break;
        }

        return view("admin.$view.index", compact('users'));
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:15',
            'role' => 'required|integer'
        ]);

        // Hash the password before saving
        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return response()->json(['success' => 'Người dùng đã được thêm thành công!'], 200);
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
    public function update(Request $request, $user)
    {
        $users = User::findOrFail($user);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $users->id,
            'phone' => 'required|string|max:15',
            'role' => 'required|integer'
        ]);

        $users->update($data);

        return response()->json(['success' => 'Người dùng đã được cập nhật thành công!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user)
    {
        $users = User::findOrFail($user);
        $users->delete();

        return response()->json(['success' => 'Người dùng đã được xóa thành công!'], 200);
    }
}
