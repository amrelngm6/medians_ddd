<?php

namespace Medians\Domain\Customers;

use Shared\dbaser\CustomController;



class Customer extends CustomController
{

	/*
	/ @var String
	*/
	protected $table = 'customers';

	public $fillable = [
		'fullname',
		'email',
		'providerId',
		'publish',
	];

	public $timestamps = false;



	function __construct()
	{

	}


	public function id() : String
	{
		return $this->id;
	}


	public function fullname() : String
	{
		return $this->fullname;
	}


	public function email() : String
	{
		return $this->email;
	}


	public function password() : String
	{
		return $this->password;
	}

	public function providerId() : ?Int
	{
		return $this->providerId;
	}

	public function publish() : ?String
	{
		return $this->publish;
	}


	public function setId($id) : void
	{
		$this->id = $id;
	}

	public function setFullname($fullname) : void
	{
		$this->fullname = $fullname;
	}

	public function setEmail($email) : void
	{
		$this->email = $email;
	}

	public function setPassword($password) : void
	{
		$this->password = $password;
	}

	public function setProviderId($providerId) : void
	{
		$this->providerId = $providerId;
	}

	public function setPublish($publish) : void
	{
		$this->publish = $publish;
	}


}
