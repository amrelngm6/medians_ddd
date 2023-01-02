<?php

namespace Medians\Infrastructure\Devices;

use Medians\Domain\Devices\Device;
use Medians\Infrastructure\Orders\OrdersRepository;
use Medians\Infrastructure\Orders\DeviceOrdersRepository;
use Medians\Infrastructure\Prices\PricesRepository;



class DevicesRepository  
{



	function __construct()
	{
	}


	/*
	// Find item by `id` 
	*/
	public function find($deviceId)
	{

		return Device::with('prices')->with('category')->find($deviceId);

	}


	/*
	// Find item by `provider` 
	*/
	public function getByProvider($providerId)
	{
		return Device::where('providerId', $providerId )
		->with('prices')
		->with('currentOrder')
		->with('category')
		->get();
	}

	/*
	// Find all items 
	*/
	public function getAll()
	{
		return  Device::with('category')->get();
	}

	/*
	// Find all items 
	*/
	public function get($limit)
	{
		return  Device::where('providerId', $providerId )
		->with('prices')
		->limit($limit)
		->get();
	}



	/*
	// Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Device();
		$Model->title = $data['title'];		
    	$Model->providerId = $data['providerId'];		
    	$Model->type = $data['type'];		
    	$Model->playing = $data['playing'];		
    	$Model->publish = $data['publish'];		
    	$Model->save();

		// Return the DeviceType object with the new data
		return $Model;
	}


	/*
	// Update item to database
	*/
	public function edit($object) : Device
	{
		$object->save();

		// Return the DeviceType object with the new data
		return Device::find($object->id);
		
	}


	/*
	// Delet item from database
	*/
	public function delete($object) 
	{

		return $object->delete();

	}





}
