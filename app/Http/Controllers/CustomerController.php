<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerController extends Controller
{
    // Phương thức xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:10',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        Auth::login($user);
        return redirect()->route('customer-home')->with('success', 'Đăng ký thành công');
        // return response()->json(['message' => 'Đăng ký thành công', 'user' => $user], 201);
    }

    // Phương thức xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Kiểm tra vai trò của người dùng
            if ($user->role === 0) {
                return redirect('/customer/home')->with('success', 'Đăng nhập thành công!');
            } else {
                Auth::logout();
                return redirect()->back()->withErrors(['email' => 'Tài khoản hoặc mật khẩu không đúng!']);
            }
        }

        return redirect()->back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác!']);
    }

    // Phương thức xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect('/customer/home')->with('success', 'Đăng xuất thành công');
    }

    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric',
        ]);

        $user = Auth::user();
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->back()->with('success', 'Số điện thoại đã được cập nhật thành công!');
    }
}
