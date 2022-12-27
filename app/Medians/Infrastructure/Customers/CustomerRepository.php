<?php

namespace Medians\Infrastructure\Customers;

use Medians\Domain\Customers\Customer;


class CustomerRepository 
{




	function __construct()
	{
	}


	public static function getModel()
	{
		return new Customer();
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




	/**
	* Save item to database
	*/
	public static function store($data) 
	{

		$Model = new Customer();
		
		foreach ($data as $key => $value) 
		{
			if (in_array($key, CustomerRepository::getModel()->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Customer::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
    }
    	

}
