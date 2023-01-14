<?php

namespace Medians\Infrastructure\Settings;

use Medians\Domain\Settings\Settings;


class SettingsRepository 
{


	public $app;


	function __construct($app)
	{
		$this->app = $app;
	}

	/*
	// Find item by `id` 
	*/
	public function find($id) : ?Settings
	{

		return Settings::where('provider_id', $this->app->provider->id)->find($id);

	}

	/*
	// Find item by `id` 
	*/
	public function getByCode($code) : ?Settings
	{
		return Settings::where('provider_id', $this->app->provider->id)->where('code', $code)->first();
	}

	/*
	// Find all items 
	*/
	public function getAll()
	{
		return  Settings::where('provider_id', $this->app->provider->id)->get();
	}


	/**
	* Save item to database
	*/
	public function store($data) 
	{

		$Model = new Settings();
		$Model->code = $data['code'];		
    	$Model->value = $data['value'];		
    	$Model->model = isset($data['model']) ? $data['model'] : '';		
    	$Model->provider_id = $data['provider_id'];		
    	$Model->created_by = $data['created_by'];		
    	$Model->save();

		// Return the Settings object with the new data
		return $Model;
	}
	

	/*
	// Delet item from database
	*/
	public function delete($code) 
	{

		return Settings::where('provider_id', $this->app->provider->id)->where('code', $code)->delete();

	}


}
