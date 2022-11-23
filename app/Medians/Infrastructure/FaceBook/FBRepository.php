<?php

namespace Medians\Infrastructure\FaceBook;

use Medians\Domain\FaceBook\FB;


class FBRepository 
{



	function __construct()
	{
	}

	/*
	// Find item by `id` 
	*/
	public function getByID($id) : ?FB
	{

		return FB::find($id);

	}

	/*
	// Find item by `id` 
	*/
	public function getByCode($code) : ?FB
	{
		return FB::where('code', $code)->first();
	}

	/*
	// Find all items 
	*/
	public function getAll()
	{
		return  FB::get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new FB();
		$Model->code = $data['code'];		
    	$Model->value = $data['value'];		
    	$Model->save();

		// Return the FB object with the new data
		return $Model;
	}
	

	/*
	// Delet item from database
	*/
	public function delete($object) 
	{

		return $object->delete();

	}


}
