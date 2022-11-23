<?php

namespace Medians\Infrastructure\Settings;

use Medians\Domain\Settings\Settings;


class SettingsRepository 
{



	function __construct()
	{
	}

	/*
	// Find item by `id` 
	*/
	public function getByID($id) : ?Settings
	{

		return Settings::find($id);

	}

	/*
	// Find item by `id` 
	*/
	public function getByCode($code) : ?Settings
	{
		return Settings::where('code', $code)->first();
	}

	/*
	// Find all items 
	*/
	public function getAll()
	{
		return  Settings::get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Settings();
		$Model->code = $data['code'];		
    	$Model->value = $data['value'];		
    	$Model->save();

		// Return the Settings object with the new data
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
