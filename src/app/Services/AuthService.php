<?php
namespace App\Services;

class AuthService
{
	public function isEmail(?string $email = null)
	{
		if (!$email)
			return false;

		if (preg_match("/^[\w._]+@[\w._]+\.[a-zA-Z]{2,}$/", $email)) {
			return true;
		}
		return false;
	}

	public function isPassword(?string $password = null)
	{
		if (!$password)
			return false;

		if (preg_match("/^[\w@.]{8,50}$/", $password)) {
			return true;
		}

		return false;
	}

	public function isUsername(?string $username = null)
	{
		if (!$username)
			return false;
		if (
			preg_match("/^[a-zA-Z0-9_]{3,30}$/", $username)
		) {
			return true;
		}
		return false;
	}

	public function isPhone(?string $phone = null): bool
	{
		if (!$phone)
			return false;
		if (preg_match("/^(03|05|07|08|09)[0-9]{8}$/", $phone))
			return true;
		return false;
	}
}