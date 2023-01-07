<?php

namespace Medians\Infrastructure\Products;

use Medians\Domain\Products\Product;



/**
 * Product class database queries
 */
class ProductsRepository 
{

	public function getModel()
	{
		return new Product;
	}

	/*
	// Find item by `id` 
	*/
	public function find($id) 
	{

		return Product::find($id);
	}

	/*
	// Find items by `provider_id` 
	*/
	public function get($provider_id) 
	{

		return Product::with('category')
		->where('provider_id', $provider_id)->get();
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
		$dataArray = [];
		foreach ($data as $key => $value) 
		{
			if (in_array($key, $Model->getFields()))
			{
				$dataArray[$key] = $value;
			}
		}	

		// Return the FBUserInfo object with the new data
    	$Object = Product::create($dataArray);
    	$Object->update($dataArray);

    	return $Object;
	}


	/*
	// Update item to database
	*/
    public function update($data)
    {

		$Object = Product::find($data['id']);
		
		// Return the FBUserInfo object with the new data
    	$Object->update( (array) $data);

    	return $Object;
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