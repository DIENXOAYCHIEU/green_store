<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\Account;
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
    public function password()
    {
        return view('user.create_password.index');
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
            // Lấy thông tin user vừa đăng nhập thành công
            $user = Auth::user();
            // Giả sử role_id = 2 là Admin 
            if ($user->role_id == 2) {
                return redirect()
                    ->route('admin.home') // Đường dẫn đến trang chủ admin 
                    ->with('success', 'Chào mừng Quản trị viên quay trở lại!');
            }

            // Mặc định cho User thường (role_id = 1)
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

    public function handleCreatePassword(Request $request)
    {
        $user = Auth::user();
        $data = $request->only(
            'password',
            'password_confirmation'
        );
        if (!empty($user->password) || $user->password != null) {
            return back()->withErrors([
                'error' => 'Tạo mật khẩu thất bại!'
            ]);
        } else {
            if (!$this->validator->isPassword($data['password'])) {
                return back()->withErrors([
                    'password' => 'Mật khẩu lớn hơn 8 và nhỏ hơn 50 ký tự'
                ])->withInput();
            }
            if ($data['password'] != $data['password_confirmation']) {
                return back()
                    ->withErrors([
                        'password_confirmation' => 'Mật khẩu không trùng khớp'
                    ])
                    ->withInput();
            }
            try {
                Account::find($user->id)->update(['password' => Hash::make($data['password'])]);
                return redirect()->route('user.home')->with('success', 'Tạo mật khẩu thành công');
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }
    }
}
