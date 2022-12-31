<?php

namespace Medians\Infrastructure\Users;

use Medians\Domain\Users\User;

class UserRepository 
{

	public $app;


	function __construct()
	{
	}

	public function getModel()
	{
		return new User;
	}

	public function find($customerId)
	{
		return User::with('Role')->find($customerId);
	}


	public function get($limit = 100)
	{
		return User::with('Role')->limit($limit)->get();
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
	

	/**
	* Update item to database
	*/
	public static function update($data) 
	{
		$Object = User::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);
    	
    	return $Object;	
	}


}
