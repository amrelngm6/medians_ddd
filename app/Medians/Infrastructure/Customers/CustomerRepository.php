<?php

namespace Medians\Infrastructure\Customers;

use Medians\Domain\Customers\Customer;
use Medians\Domain\Customers\LocationsInfo;
use Medians\Domain\Properties\Files;


class CustomerRepository 
{

	public $app;



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

	public function get($limit = 100)
	{
		return Customer::limit($limit)->get();
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
	public function storeLocation($data, $id) 
	{

		$Model = LocationsInfo::firstOrCreate([
			'model_type' => Customer::class,
			'model_id' => $id,
		]);
		$data['model_type'] = Customer::class;
		$data['model_id'] = $id;
		$Model->update($data);

		return $Model;
	}




	/**
	* Save item to database
	*/
	public function store($data) 
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
    	$Model = Customer::create($dataArray);
    	$Model->update($dataArray);

    	// Store Location data 
    	$this->storeLocation( (array) $data['location'], $Model->id);

    	return $Model;
    }
    	
	/**
	* Update item to database
	*/
	public function update($data) 
	{
		$Object = Property::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);
    	
    	// Store Location data 
    	$this->storeLocation( (array) $data['location'], $Object->id);

    	return $Object; 

	}



}
