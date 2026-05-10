<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class AccountController extends Controller
{
	public function __construct(
		private AuthService $validator
	) {
	}

	public function index()
	{
		return view('user.account.profile');
	}

	public function create()
	{
		return view('user.register.index');
	}

	// xử lý register ở đây
	public function store(Request $request)
	{
		$data = $request->only([
			'username',
			'phone',
			'email',
			'password',
			'password_confirmation'
		]);

		// Validate
		if (!$this->validator->isUsername($data['username'])) {
			return back()
				->withErrors([
					'username' => 'Username tối thiếu 3 đến 30 kí tự'
				])
				->withInput();
		}

		if (!$this->validator->isPhone($data['phone'])) {
			return back()
				->withErrors([
					'phone' => '10 số bắt đầu bằng 03 05 07 08 09'
				])
				->withInput();
		}

		if (!$this->validator->isEmail($data['email'])) {
			return back()
				->withErrors([
					'email' => 'Email phải có dạng example123@gmail.com'
				])
				->withInput();
		}

		if (!$this->validator->isPassword($data['password'])) {
			return back()
				->withErrors([
					'password' => 'Mật khẩu lớn hơn 8 và nhỏ hơn 50 ký tự'
				])
				->withInput();
		}

		if ($data['password'] != $data['password_confirmation']) {
			return back()
				->withErrors([
					'password_confirmation' => 'Mật khẩu không trùng khớp'
				])
				->withInput();
		}

		// Check username tồn tại
		if (Account::where('username', $data['username'])->exists()) {
			return back()
				->withErrors([
					'username' => 'Username đã được sử dụng'
				])
				->withInput();
		}
		// Check phone tồn tại
		if (Account::where('phone', $data['phone'])->exists()) {
			return back()
				->withErrors([
					'phone' => 'Số điện thoại đã được đăng ký'
				])
				->withInput();
		}
		// Check email tồn tại
		if (Account::where('email', $data['email'])->exists()) {
			return back()
				->withErrors([
					'email' => 'Email đã được đăng ký'
				])
				->withInput();
		}

		// Tạo account
		$account = Account::create([
			'username' => $data['username'],
			'phone' => $data['phone'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
			'avatar' => '',
			'role_id' => 1
		]);

		// Login tự động
		Auth::login($account);

		return redirect()
			->route('user.home')
			->with('success', 'Đăng ký thành công');
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
	public function update(Request $request)
	{
		$data = $request->only([
			'id',
			'username',
			'phone',
		]);

		// Validate
		if (!$this->validator->isUsername($data['username'])) {
			return back()
				->withErrors([
					'username' => 'Username tối thiếu 3 đến 30 kí tự'
				])
				->withInput();
		}

		if (!$this->validator->isPhone($data['phone'])) {
			return back()
				->withErrors([
					'phone' => '10 số bắt đầu bằng 03 05 07 08 09'
				])
				->withInput();
		}

		try {
			$user = Account::find($data['id'])->update([
				'username' => $data['username'],
				'phone' => $data['phone']
			]);
			return back()->with('success', 'Cập nhật thông tin thành công!');
		} catch (\Throwable $th) {
			return back()->with('error', 'Cập nhật thông tin thất bại!');
		}

	}

	public function updateAvatar(Request $request)
	{
		$request->validate([
			'avatar' => 'required|image|mimes:jpeg,png|max:1024'
		]);

		try {
			$uploadApi = Cloudinary::uploadApi();
			
			$upload = $uploadApi->upload(
				$request->file('avatar')->getRealPath(),
				['folder' => '/green_store_folder/avatar']
			);

			$url = $upload['secure_url'];

			Account::find(Auth::id())->update([
				'avatar' => $url
			]);

			return response()->json([
				'success' => true,
				'url' => $url
			]);

		} catch (\Throwable $th) {
			return response()->json([
				'success' => false,
				'message' => $th->getMessage()
			], 500);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
