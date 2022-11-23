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

		$check = FBPageInfo::where('user_id', $data['user_id'])
		->where('facebook_rx_fb_user_info_id', $data['facebook_rx_fb_user_info_id'])
		->where('page_id', $data['page_id'])
		->first();

		if ($check)
		{
			return $check->delete();
		}

		// Return the FBPageInfo object with the new data
    	return FBPageInfo::create($data);

	}
	

	/*
	// Delet item from database
	*/
	public function delete($object) 
	{

		return $object->delete();

	}


}
