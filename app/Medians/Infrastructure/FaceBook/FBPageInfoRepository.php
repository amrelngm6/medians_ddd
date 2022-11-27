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
	public function getByPageId($page_id) : ?FB
	{
		return FBPageInfo::where('page_id', $page_id)->first();
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
	 * Set mobel attributes
	 * 
	*/
	public function create(Array $data, $Model = null)
	{
		if (!$Model)
		{
			$Model = new FBPageInfo();
		}

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

		$check = FBPageInfo::where('user_id', $data['user_id'])
		->where('facebook_rx_fb_user_info_id', $data['facebook_rx_fb_user_info_id'])
		->where('page_id', $data['page_id'])
		->first();


		// Return the FBPageInfo object with the new data
    	return $this->create((array) $data, $check);

	}
	

	/*
	// Delet item from database
	*/
	public function delete($object) 
	{

		return $object->delete();

	}


}
