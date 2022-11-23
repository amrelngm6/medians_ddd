<?php

namespace Medians\Infrastructure\Administrators;

use Medians\Domain\Users\User;

class AdminRepository 
{

	/*
	/ @var String
	*/
	protected $table = 'administrators';


	/*
	/ @var Int
	*/
	private $id;


	/*
	/ @var Array
	*/
	private $data = array();



	function __construct()
	{
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
