<?php

namespace Medians\Infrastructure\Users;

use Medians\Domain\Users\User;

class UserRepository 
{

	public $app;


	function __construct($app)
	{
		$this->app = $app;
	}

	public function getModel()
	{
		return new User;
	}

	public function find($customerId)
	{
		return User::with('Role')->with('provider')->find($customerId);
	}

	public function checkDuplicate($param)
	{
		if (User::where('email', $param['email'])->first())
		{
			return 'Email already found';
		}
	}


	public function get($limit = 100)
	{
		return User::with('Role', 'provider')->where('provider_id', $this->app->provider->id)->limit($limit)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new User();

		$Model = $Model->firstOrCreate($data);

    	$Model->update($data);
    	
    	$data['id'] = $Model->id;
    	$this->checkUpdatePassword($data);

		// Return the FBUserInfo object with the new data
    	return $Model;

	}
	

	/**
	* Update item to database
	*/
	public function update($data) 
	{
		$Object = User::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);
    	
    	$data['id'] = $Object->id;
    	$this->checkUpdatePassword($data);

    	return $Object;	
	}

	/**
	* Update item to database
	*/
	public static function checkUpdatePassword($data) 
	{
		if (isset($data['id']))
		{
			$Object = User::find($data['id']);
		}

		if (!empty($data['password']))
		{
			// Return the FBUserInfo object with the new data
    		$Object->password =  User::encrypt($data['password']);
    		$Object->save();
		}
    	
    	return isset($Object) ? $Object : null;	
	}


}
