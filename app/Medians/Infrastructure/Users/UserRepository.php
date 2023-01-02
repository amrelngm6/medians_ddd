<?php

namespace Medians\Infrastructure\Users;

use Medians\Domain\Users\User;

class UserRepository 
{




	function __construct()
	{
	}

	public function find($customerId)
	{

		return User::with('providers')->find($customerId);

	}


	public function getByID($customerId)
	{

		return User::find($customerId);

	}


	public function getByEmail($email)
	{

		return  User::where('email', $email)->first();
	}


	public function checkLogin($email, $password)
	{

		return User::where('password', $password)->where('email' , $email)->first();
	}




}
