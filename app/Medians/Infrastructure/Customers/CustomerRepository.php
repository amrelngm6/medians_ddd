<?php

namespace Medians\Infrastructure\Customers;

use Medians\Domain\Customers\Customer;


class CustomerRepository 
{




	function __construct()
	{
	}

	public function find($customerId)
	{

		return Customer::find($customerId);
	}


	public function getByEmail($email)
	{
		return  Customer::where('email', $this->email)->first();
	}


	public function checkLogin($email, $password)
	{
		return  Customer::where('email', $email)
		->where('password', $password)
		->first();

	}




}
