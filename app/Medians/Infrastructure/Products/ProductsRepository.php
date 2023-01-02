<?php

namespace Medians\Infrastructure\Products;

use Medians\Domain\Products\Product;



/**
 * Product class database queries
 */
class ProductsRepository 
{



	/*
	// Find item by `id` 
	*/
	public function find($id) 
	{

		return Product::find($id);
	}


	/*
	// Find item by `id` 
	*/
	public function getById($id) 
	{

		return Product::find($id);

	}


	/*
	// Find items by `providerId` 
	*/
	public function getByProvider($providerId) 
	{

		return Product::with(['total_stock'=>function($q)
		{
			return $q->sum('stock');
		}])
		->where('providerId', $providerId)->get();
	}


	/*
	// Find all items 
	*/
	public function getAll($limit = null)
	{
		return  Product::limit($limit)->get();
	}



	/**
	* Save item to database
	*/
	public function store($data) 
	{	

		$Model = new Product();
		$Model->setTitle($data['title'])
		->setProviderId ($data['providerId'])
		->setPicture($data['picture'])
		->setPublish($data['publish'])
		->save();

		// Return the DeviceType object with the new data
		return $Model;
	}


	/*
	// Update item to database
	*/
	public function edit($object) : Product
	{
		$object->save();

		// Return the DeviceType object with the new data
		return Product::find($object->id);
		
	}



	/**
	* Delete item to database
	*
	* @Returns Boolen
	*/
	public function delete($id) 
	{
		try {
			
			return Product::find($id)->delete();

		} catch (Exception $e) {

			throw new Exception("Error Processing Request " . $e->getMessage(), 1);
			
		}
	}


}