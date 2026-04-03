<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function create()
    {
        return view('password.request.index');
    }

    public function store(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Laravel's built-in broker handles token generation and email sending
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status),
                            'success' => 'Gửi yêu cầu hoàn thành. Hãy kiểm tra hộp thư Email của bạn.'])
            : back()->withErrors(['email' => __($status)]);
    }

    public function edit($token)
    {
        return view('password.reset.index', [
            'token' => $token,
            'email' => request()->email
        ]);
    }

    public function update(Request $request)
    {
        // validate input
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),

            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.login')->with('success', 'Đổi mật khẩu thành công')
            : back()->with('error', 'Tạo mật khẩu thất bại!')->withErrors([['password' => __($status)]]);
    }
}