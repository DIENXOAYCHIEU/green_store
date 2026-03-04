<?php
namespace App\Services;

class ValidatorService{
	public function isEmail(?string $email=null){
		if (!$email) return false;

		if(preg_match("/^[\w._]+@[\w._]+\.[a-zA-Z]{2,}$/",$email)){
			return true;
		}
		return false;
	}

	public function isPassword(?string $password=null){
		if (!$password) return false;

		if(preg_match("/^[\w@.]{8,50}$/", $password)){
			return true;
		}

		return false;
	}
}