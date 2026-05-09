<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = Account::with('roles');

        if ($request->filled('q')) {
            $term = $request->query('q');
            $query->where(function ($q) use ($term) {
                $q->where('username', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role_id', $request->query('role'));
        }

        $accounts = $query->orderBy('id', 'desc')->get();
        $roles = Role::all();

        return view('admin.users.index', compact('accounts', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function show(string $id)
    {
        $account = Account::with('roles')->findOrFail($id);
        return view('admin.users.show', compact('account'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|max:30|unique:accounts,username',
            'email' => 'required|email|unique:accounts,email',
            'phone' => 'required|string|unique:accounts,phone',
            'password' => 'required|string|min:8|max:50|confirmed',
            'role_id' => 'required|exists:roles,id',
        ], [
            'username.required' => 'Vui lòng nhập tên người dùng.',
            'email.required' => 'Vui lòng nhập email.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        Account::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'role_id' => $request->input('role_id'),
            'avatar' => '',
        ]);

        return redirect()->route('admin.users')->with('success', 'Tạo tài khoản mới thành công.');
    }

    public function edit(string $id)
    {
        $account = Account::findOrFail($id);
        $roles = Role::all();
        return view('admin.users.edit', compact('account', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $account = Account::findOrFail($id);

        $request->validate([
            'username' => 'required|string|min:3|max:30|unique:accounts,username,' . $account->id,
            'email' => 'required|email|unique:accounts,email,' . $account->id,
            'phone' => 'required|string|unique:accounts,phone,' . $account->id,
            'role_id' => 'required|exists:roles,id',
        ], [
            'username.required' => 'Vui lòng nhập tên người dùng.',
            'email.required' => 'Vui lòng nhập email.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
        ]);

        $account->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'role_id' => $request->input('role_id'),
        ]);

        return redirect()->route('admin.users')->with('success', 'Cập nhật tài khoản thành công.');
    }

    public function destroy(string $id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('admin.users')->with('success', 'Xóa tài khoản thành công.');
    }

    public function lock(string $id)
    {
        $account = Account::findOrFail($id);
        $account->update(['is_locked' => true]);
        return redirect()->back()->with('success', 'Tài khoản đã được khóa.');
    }

    public function unlock(string $id)
    {
        $account = Account::findOrFail($id);
        $account->update(['is_locked' => false]);
        return redirect()->back()->with('success', 'Tài khoản đã được mở khóa.');
    }
}
