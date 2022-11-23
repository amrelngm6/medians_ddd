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


	/**
	* Save item to database
	*/
	public static function store($data) 
	{

		$Model = new User();
		
		// Return the FBUserInfo object with the new data
    	return $Model->firstOrCreate( (array) $data);

	}
	


}
