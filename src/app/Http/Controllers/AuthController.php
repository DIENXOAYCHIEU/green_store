<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function __construct(
        private AuthService $validator
    ) {
    }

    public function login()
    {
        return view('user.login.index');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$this->validator->isEmail($credentials['email'])) {
            return back()
                ->withErrors([
                    'email' => 'Email phải có dạng example123@gmail.com'
                ])
                ->withInput();
        }

        if (!$this->validator->isPassword($credentials['password'])) {
            return back()
                ->withErrors([
                    'password' => 'Mật khẩu lớn hơn 8 và nhỏ hơn 50 ký tự'
                ])
                ->withInput();
        }

        if (
            Auth::attempt([
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ])
        ) {
            return redirect()
                ->route('user.home')
                ->with('success', 'Đăng nhập thành công');
        }
        return back()
            ->with('error', 'Không tìm thấy tài khoản. Vui lòng nhập lại thông tin');
    }
    public function handleLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('user.home')
            ->with('success', 'Đăng xuất thành công');
    }
}
