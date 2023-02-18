<?php

namespace Medians\Infrastructure\Providers;

use Medians\Domain\Providers\Provider;


class ProviderRepository   
{


	public $app;


	function __construct($app )
	{
		$this->app = $app;
	}

	public function get()
	{

		return Provider::get();

	}


	public function find($id)
	{

		return Provider::where('id', $id)->first();

	}


	/*
	// Save item to database
	*/
	public function saveItem() 
	{

		unset($this->data['id']);

		// Insert data and return ID
		$this->id = $this->insert((array) $this->data, $this->getTable());

		// Return the OrderModel object with the new data
		return $this->getById($this->id);
	}

	/*
	// Update item to database
	*/
	public function edit() : Object
	{

		// Update data and return boolen
		$this->updated = $this->update((array) $this->data, 'id', $this->id);

		// Return the OrderModel object with the new data
		return $this->getById($this->id);
	}



	/*
	// Delete item to database
	//
	// @Returns OrderModel
	*/
	public function remove() 
	{

		// Delete data and return boolen
		$this->deleted = $this->delete($this->id);

		// Return the OrderModel object with the new data
		return $this->deleted ? true : false;
	}



}
