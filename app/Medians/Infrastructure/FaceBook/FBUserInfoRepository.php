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
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new FBUserInfo();
		
		// Return the FBUserInfo object with the new data
    	return $Model->firstOrCreate($data);

	}
	

	/*
	// Delet item from database
	*/
	public function delete($object) 
	{

		return $object->delete();

	}


}
