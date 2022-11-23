<?php

namespace Medians\Infrastructure\FaceBook;

use Medians\Domain\FaceBook\FBPageInfo;

class FBPageInfoRepository 
{



	function __construct()
	{
	}

	/*
	// Find item by `id` 
	*/
	public function getByID($id) : ?FBPageInfo
	{

		return FBPageInfo::find($id);

	}

	/*
	// Find item by `id` 
	*/
	public function getByCode($code) : ?FBPageInfo
	{
		return FBPageInfo::where('code', $code)->first();
	}

	/*
	// Find all items 
	*/
	public function getAll()
	{
		return  FBPageInfo::get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new FBPageInfo();
		
		// Return the FBPageInfo object with the new data
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
