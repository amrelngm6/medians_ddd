<?php

namespace Medians\Infrastructure\FaceBook;

use Medians\Domain\FaceBook\FBUserInfo;

class FBUserInfoRepository 
{



	function __construct()
	{
	}

	/*
	// Find item by `id` 
	*/
	public function getByID($id) : ?FBUserInfo
	{

		return FBUserInfo::find($id);

	}

	/*
	// Find item by `id` 
	*/
	public function getByCode($code) : ?FBUserInfo
	{
		return FBUserInfo::where('code', $code)->first();
	}

	/*
	// Find all items 
	*/
	public function getAll()
	{
		return  FBUserInfo::get();
	}

	/**
	 * Set mobel attributes
	 * 
	*/
	public function create(Array $data)
	{
		$Model = new FBPageInfo();

		foreach ($data as $key => $value) 
		{
			$Model->$key = $value;
		}

		$Model->save();
		
		return $Model;
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$check = FBUserInfo::where('user_id', $data['user_id'])
		->where('facebook_rx_config_id', $data['facebook_rx_config_id'])
		->where('fb_id', $data['fb_id'])
		->first();

		if ($check)
		{
			return $check->delete();
		}

		// Return the FBPageInfo object with the new data
    	return $this->create((array) $data);
	}
	

	/*
	// Delet item from database
	*/
	public function delete($object) 
	{

		return $object->delete();

	}


}
